<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Word;

class WordsController extends Controller
{
    /**
     * Loads words from a file to the database
     * 
     * @param  Request  $request
     * @param string $parameterized_url
     * @return void
     */
    public function load(Request $request, $parameterized_url) {
        $url = str_replace(',', '/', $parameterized_url);
        
        $words_file = fopen('http://'.$url, 'r') or die('Unable to open file!');
        while(!feof($words_file)) {
        /*
        for ($i=0; $i < 5; $i++) {
        */
            $word = trim(fgets($words_file));
            $word_length = strlen($word);
            $letters_array = str_split($word);
            sort($letters_array);
            $ordered_letters = implode('', $letters_array);


            /*
            */
            $word_instance = new Word;
            $word_instance->word = $word;
            $word_instance->length = $word_length;
            $word_instance->ordered_letters = $ordered_letters;
            $word_instance->save();
            /*
            var_dump($ordered_letters);
            echo '<br>';
            */
        }
        fclose($words_file);
    }
}
