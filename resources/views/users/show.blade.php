@extends('layouts.default')

@section('title', '个人中心')

@section('content')
    <h1>个人中心</h1>
    <p>{{ $user->name }} - {{ $user->email }}</p>
@stop