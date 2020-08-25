<!-- @extends('layouts.app') -->
@section('title', '操作成功')

@section('content')
  <div class="card">
    <div class="card-header">{{ __('shop.page.success') }}</div>
    <div class="card-body text-center">
      <h1>{{ $msg }}</h1>
      <!-- <a class="btn btn-primary" href="{{ route('root') }}">{{ __('shop.page.gohome') }}</a> -->
    </div>
  </div>
@endsection