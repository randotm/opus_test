@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <form method='POST' action='/anagram' enctype='multipart/form-data'>
                    @csrf
                    <input type='text' name='word' id='word' />
                    <input type='submit' />
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
