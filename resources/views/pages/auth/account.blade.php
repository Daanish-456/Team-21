@extends('layouts.app')

@section('title', 'Stone & Soul - Account')

@section('content')
    <a href="{{ route('logout') }}">Log Out</a>
    <p>Welcome, {{ $user->Name }}.</p>
@endsection