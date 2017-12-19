@extends('layouts.app')

@section('header')
    <style>
        .jumbotron { background-color: hsl(171, 100%, 41%); color: hsl(0, 0%, 100%); margin-bottom: 0; padding: 20px;}
        .jumbotron p { margin-bottom: 0; font-size: 1em; }
        .content { padding-left: 20px; padding-right: 20px; }
        .section { padding: 10px; }
    </style>
@endsection

@section('content')
    <div class="jumbotron">
        <div class="content">
            <h1>СУМБУР 1.0</h1>
            <h2>Система Управления Мебелью. Блок Установки и Ремонта.</h3>

            @if(Auth::check())
                <p>Добро пожаловать, {{ auth()->user()->name }}!</p>
            @else
                <a href="/login" class="btn btn-primary">Login</a>
                <a href="/register" class="btn btn-primary">Sign Up</a>
            @endif

            <hr>
            <p>Пользователь: email: user@hamelius.ru, password: password</p>
            <p>Администратор: email: admin@hamelius.ru, password: password</p>
        </div>
    </div>
    @auth
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7 section">
                    @include('orders.index')
                </div>
                <div class="col-md-5 section">
                    @include('furniture.index')
                </div>
            </div>
        </div>
    @endauth
@endsection
