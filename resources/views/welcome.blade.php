@extends('layouts.app')
@section('title', 'Главная страница')
@section('content')
    @include('partials.header')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-10 mb-20">
        <div class="text-center">Контент доступный гостям</div>
    </div>
@endsection
