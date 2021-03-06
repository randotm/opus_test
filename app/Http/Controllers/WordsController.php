<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use \App\Word;

class WordsController extends Controller
{

    /**
     * Loads words from a file to the database
     * 
     * @param Request $request
     * @return JSON
     */
    public function load_to_db(Request $request) {
        // Response creation
        $response = array();
        $response['status'] = 200;
        $response['message'] = 'OK';

        // File upload handling
        $path = $request->file('upload')->store('word_files');
        $words_file = Storage::get($path);
        $words = explode(chr(10), $words_file);

        // Saving words to db, error reporting
        foreach ($words as $word) {
            $error = $this->save_word($word);
            if ($error != '') {
                $response['status'] = 400;
                $response['message'] = 'Bad Request';
                $response['errors'] = $this->word_save_response_handling($word, $error);
            }
        }

        return json_encode($response);
    }

    /**
     * Outputting response content in case of database error
     * 
     * @param string $word
     * @param string $error
     * @return array
     */
    private function word_save_response_handling(string $word, string $error) {
        $problem = array();
        $problem['word'] = $word;
        $problem['error'] = $error;

        return $problem;
    }

    /**
     * Saves given word to database
     * 
     * @param string $word
     * @return string
     */
    private function save_word(string $word) {
        $error = '';
        
        $word_length = strlen($word);
        $letters_array = str_split($word);
        sort($letters_array);
        $ordered_letters = implode('', $letters_array);
        
        $word_instance = new Word;
        $word_instance->word = $word;
        $word_instance->length = $word_length;
        $word_instance->ordered_letters = $ordered_letters;
        
        try { 
            $word_instance->save();
        } catch(QueryException $ex){ 
            $error = $ex->getMessage();
        }

        return $error;
    }

    /**
     * Gets anagrams for the word from database
     * 
     * @param string $word
     * @return array
     */
    public function get_anagrams(Request $request) {

        $word = $request->word;
        $sad = array();
        $sad['word'] = $word;
        //dd(json_encode($sad));
        $word_length = strlen($word);
        $letters_array = str_split($word);
        sort($letters_array);
        $ordered_letters = implode('', $letters_array);
        
        $anagrams = Word::where('length', $word_length)->where('ordered_letters', $ordered_letters)->where('word', '!=', $word)->get();

        return $anagrams;
    }
    
    /**
     * Shows login view
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function react_login_form() {
        return view ('react.login');
    }

    /**
     * Shows words upload to database view
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function react_upload_form() {
        return view ('react.upload');
    }

    /**
     * Shows anagram querying and answers view
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function react_anagrams_form() {
        return view ('react.anagram');
    }
}

