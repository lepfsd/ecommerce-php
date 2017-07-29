@extends("layouts.app")

@section("content")
<div class="container white">
  <div class="panel panel-default">
      <div class="panel-heading">
          <div class="clearfix">
              <span class="panel-title">Crear Producto</span>
          </div>
      </div>
      <div class="panel-body">
          @include('products.form',['product'=> $product, 'url' => 'products', 'method' => 'POST'])
      </div>
  </div>
</div>
@endsection
