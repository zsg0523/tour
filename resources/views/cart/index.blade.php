@extends('layouts.app')
@section('title', '购物车')

@section('content')
<div class="row">
<div class="col-lg-10 offset-lg-1">
<div class="card">
  <div class="card-header">我的购物车</div>
  <div class="card-body">
    <table class="table table-striped">
      <thead>
      <tr>
        <th><input type="checkbox" id="select-all"></th>
        <th>商品信息</th>
        <th>单价</th>
        <th>数量</th>
        <th>操作</th>
      </tr>
      </thead>
      <tbody class="product_list">
      @foreach($cartItems as $item)
        <tr data-id="{{ $item->shopProductSku->id }}">
          <td>
            <input type="checkbox" name="select" value="{{ $item->shopProductSku->id }}" {{ $item->shopProductSku->shopProduct->on_sale ? 'checked' : 'disabled' }}>
          </td>
          <td class="product_info">
            <div class="preview">
              <a target="_blank" href="{{ route('products.show', [$item->shopProductSku->product_id]) }}">
                <img src="{{ $item->shopProductSku->shopProduct->image_url }}">
              </a>
            </div>
            <div @if(!$item->shopProductSku->shopProduct->on_sale) class="not_on_sale" @endif>
              <span class="product_title">
                <a target="_blank" href="{{ route('products.show', [$item->shopProductSku->shop_product_id]) }}">{{ $item->shopProductSku->shopProduct->title }}</a>
              </span>
              <span class="sku_title">{{ $item->shopProductSku->title }}</span>
              @if(!$item->shopProductSku->shopProduct->on_sale)
                <span class="warning">该商品已下架</span>
              @endif
            </div>
          </td>
          <td><span class="price">￥{{ $item->shopProductSku->price }}</span></td>
          <td>
            <input type="text" class="form-control form-control-sm amount" @if(!$item->shopProductSku->shopProduct->on_sale) disabled @endif name="amount" value="{{ $item->amount }}">
          </td>
          <td>
            <button class="btn btn-sm btn-danger btn-remove">移除</button>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
@endsection