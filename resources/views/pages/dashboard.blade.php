@extends('layouts.master')

@section('content')

<div class="app-main__outer" style="margin-top: 10%;">
    <div class="app-main__inner text-center">
        <h4>É MUITO BOM TE VER POR AQUI</h4>
        <h4 style="color: #008000;"> {{ Auth::user()->name }}</h4>
    </div>
</div>

@endsection
