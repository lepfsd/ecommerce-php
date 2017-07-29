@extends("layouts.app")

@section("content")
<div class="container white">
  <div class="panel panel-default">
      <div class="panel-heading">
          <div class="clearfix">
              <span class="panel-title">edit product</span>
          </div>
      </div>
      <div class="panel-body">
          @include('products.form',['product' => $product, 'url' => 'products/'.$product->id, 'method'=>'PATCH'])
      </div>
  </div>
</div>
@endsection
