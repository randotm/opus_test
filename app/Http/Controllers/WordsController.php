<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \App\Word;

class WordsController extends Controller
{
    /**
     * Loads words from a file to the database
     * 
     * @param  Request  $request
     * @return void
     */
    public function load(Request $request) {

        $path = $request->file('upload')->store('word_files');
        $words_file = Storage::get($path);
        $words = explode(chr(10), $words_file);

        foreach ($words as $word) {
            $word_length = strlen($word);
            $letters_array = str_split($word);
            sort($letters_array);
            $ordered_letters = implode('', $letters_array);

            $word_instance = new Word;
            $word_instance->word = $word;
            $word_instance->length = $word_length;
            $word_instance->ordered_letters = $ordered_letters;
            $word_instance->save();
        }

    }

    /**
     * Shows file upload view for adding words to database
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function form() {
        return view('upload');
    }
}
