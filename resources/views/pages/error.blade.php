@extends('layouts.app')
@section('title', '错误')

@section('content')
<div class="card">
    <div class="card-header">{{ __('shop.page.error') }}</div>
    <div class="card-body text-center">
        <h1>{{ $msg }}</h1>
        <a class="btn btn-primary" href="{{ route('root') }}">{{ __('shop.page.gohome') }}</a>
    </div>
</div>
@endsection