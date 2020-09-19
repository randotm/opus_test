@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <p>Word: {{ $word }}</p>
                <p>Anagrams:</p>
                <ul>
                @foreach ($anagrams as $anagram)
                    <ol>{{ $anagram->word }}</ol>
                @endforeach
                </ul>
                
            </div>
        </div>
    </div>
</div>
@endsection
