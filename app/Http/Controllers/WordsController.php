<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \App\Word;

class WordsController extends Controller
{

    /**
     * Shows file upload view for adding words to database
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function load_to_db_form() {
        return view('upload');
    }

    /**
     * Loads words from a file to the database
     * 
     * @param  Request  $request
     * @return void
     */
    public function load_to_db(Request $request) {

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
     * Shows anagram querying view
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function anagram_form() {
        return view('anagram_form');
    }

    /**
     * Loads words from a file to the database
     * 
     * @param  Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function get_anagrams(Request  $request) {

        $word = $request->word;
        $word_length = strlen($word);
        $letters_array = str_split($word);
        sort($letters_array);
        $ordered_letters = implode('', $letters_array);
        
        $anagrams = Word::where('length', $word_length)->where('ordered_letters', $ordered_letters)->where('word', '!=', $word)->get();

        return view('anagrams', ['word' => $word, 'anagrams' => $anagrams]);
    }
    
}
