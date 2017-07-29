{!! Form::open(['url' => 'in_shooping_carts', 'method' => 'POST', 'class' => 'inline-block add-to-cart']) !!}
  <input type="hidden" name="product_id" value="{{$product->id}}">
  <input type="submit" class="btn btn-info" value="Add to cart">
{!! Form::close() !!}
