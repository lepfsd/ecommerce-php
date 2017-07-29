@extends('layouts.app')

@section('content')

<header class="big-padding text-center blue-grey white-text">
  <h2>Compra completada</h2>
</header>

<div class="container">
    <div class="card large-padding">
      <h3>Tu pago fue
        @if($order->status === "created")
          <span class="created">{{$order->status}}</span>
        @else
          <span>{{$order->status}}</span>
        @endif
      </h3>
      <p>Corrobora los datos del envio</p>
      <div class="row large-padding">
        <div class="col-xs-6">total</div>
        <div class="col-xs-6">{{$order->total}}</div>
      </div>
      
      <div class="text-center top-space">
        <a href="{{url('/compras/'.$shopping_cart->customid)}}" target="_blank">Link permanente de tu compra</a>
      </div>
    </div>
</div>

@endsection
