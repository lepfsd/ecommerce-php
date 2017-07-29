@extends('layouts.app')

@section('content')
  <div class="big-padding text-center blue-grey white-text">
    <h4>Your shooping cart</h4>
  </div>

  <div class="container">
    <table class="table table-bordered">
      <thead>
        <tr>
          <td>Product</td>
          <td>Price</td>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
          <tr>
            <td>{{$product->title}}</td>
            <td>{{$product->pricing}}</td>
          </tr>
        @endforeach
        <tr>
          <td>Total</td>
          <td><strong>{{$total}}</strong></td>
        </tr>
      </tbody>
    </table>
    <div class="pull-right">
      @include('shopping_carts.form')
    </div>
  </div>
@endsection
