@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

            <form method='POST' action='/upload' enctype='multipart/form-data'>
                @csrf
                <input type='file' name='upload' id='upload' />
                <input type='submit' />
            </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
