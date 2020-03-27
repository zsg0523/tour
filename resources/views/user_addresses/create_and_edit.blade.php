@extends('layouts.app')
@section('title', ($address->id ? '修改': '新增') . '收货地址')

@section('content')
<div class="row">
  <div class="user_main disflex">
        <div class="col-xs-3 col-sm-3 col-md-2 col-lg-2 mobileMenu">
            @include('layouts._menu')
        </div>
        <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10">
        <div class="col-md-12">
          <div class="card">
          <div class="card-header">
            <h2 class="text-center">
              @if($address->id)
              	{{ __("shop.address.modifyaddress") }}
              @else
                {{ __("shop.address.newaddress") }}
              @endif
            </h2>
          </div>
          <div class="card-body">
            <!-- 输出后端报错开始 -->
            @if (count($errors) > 0)
              <div class="alert alert-danger">
                <h4>有错误发生：</h4>
                <ul>
                  @foreach ($errors->all() as $error)
                    <li><i class="glyphicon glyphicon-remove"></i> {{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <!-- 输出后端报错结束 -->
            <!-- inline-template 代表通过内联方式引入组件 -->
            <user-addresses-create-and-edit inline-template>
              @if($address->id)
                <form class="form-horizontal" role="form" action="{{ route('user_addresses.update', ['user_address' => $address->id]) }}" method="post">
                  {{ method_field('PUT') }}
              @else
                <form class="form-horizontal" role="form" action="{{ route('user_addresses.store') }}" method="post">
              @endif
              {{ csrf_field() }}
              <!-- 注意这里多了 @change -->
                <!-- <select-district :init-value="{{ json_encode([$address->province, $address->city, $address->district]) }}" @change="onDistrictChanged" inline-template>
                  <div class="form-group row">
                    <label class="col-form-label col-sm-2 text-md-right">{{ __("shop.address.city") }}</label>
                    <div class="col-sm-3">
                      <select class="form-control" v-model="provinceId">
                        <option value="">选择省</option>
                        <option v-for="(name, id) in provinces" :value="id">@{{ name }}</option>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <select class="form-control" v-model="cityId">
                        <option value="">选择市</option>
                        <option v-for="(name, id) in cities" :value="id">@{{ name }}</option>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <select class="form-control" v-model="districtId">
                        <option value="">选择区</option>
                        <option v-for="(name, id) in districts" :value="id">@{{ name }}</option>
                      </select>
                    </div>
                  </div>
                </select-district> -->
                <!-- 插入了 3 个隐藏的字段 -->
                <!-- 通过 v-model 与 user-addresses-create-and-edit 组件里的值关联起来 -->
                <!-- 当组件中的值变化时，这里的值也会跟着变 -->
                <input type="hidden" name="province" v-model="province">
                <input type="hidden" name="city" v-model="city">
                <input type="hidden" name="district" v-model="district">
                <div class="form-group row">
                  <label class="col-form-label text-md-right col-sm-2">{{ __("shop.address.addressinfo") }}</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="address" value="{{ old('address', $address->address) }}">
                  </div>
                </div>
                <!-- <div class="form-group row">
                  <label class="col-form-label text-md-right col-sm-2">{{ __("shop.address.postcode") }}</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="zip" value="{{ old('zip', $address->zip) }}" oninput="value=value.replace(/[^\d]/g,'')"/>
                  </div>
                </div> -->
                <div class="form-group row">
                  <label class="col-form-label text-md-right col-sm-2">{{ __("shop.address.name") }}</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="contact_name" value="{{ old('contact_name', $address->contact_name) }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label text-md-right col-sm-2">{{ __("shop.address.phone") }}</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="contact_phone" value="{{ old('contact_phone', $address->contact_phone) }}">
                  </div>
                </div>
                <div class="form-group row text-center">
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">{{ __("shop.address.submit") }}</button>
                  </div>
                </div>
              </form>
            </user-addresses-create-and-edit>
          </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('scriptsAfterJs')
<script>
    $(document).ready(function() {
     $('.menu_list li.menu_list_address').addClass('active'); 
  });
</script>
@endsection