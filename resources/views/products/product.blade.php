<div class="card product text-left">
  @if(Auth::check()&&($product->user_id == Auth::user()->id))
    <div class="absolute actions text-right">
      <a href="{{route('products.edit', $product)}}" class="btn btn-info">edit</a>
      <form class="form-inline" method="post"
      action="{{route('products.destroy', $product)}}"
      onsubmit="return confirm('Sure?')">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <input type="hidden" name="_method" value="DELETE">
        <input type="submit" value="delete" class="btn btn-danger">
      </form>
    </div>
  @endif
  <h4>{{$product->title}}</h4>
  <div class="row">
    <div class="col-sm-6 col-xs-12">
      @if($product->extension)
        <img src="{{url("/products/images/$product->id.$product->extension")}}" alt="" class="product-avatar">
      @endif
    </div>
    <div class="col-sm-6 col-xs-12">
      <p>
        <strong>description</strong>
      </p>
      <p>
        {{$product->description}}
      </p>
      <p>
        @include("in_shopping_carts.form",["product" => $product])
      </p>
    </div>
  </div>
</div>
