@extends("layouts.app")

@section("content")
<div class="big-padding text-center blue-grey white-text">
  <h4>Products</h4>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      @if(Session::has('message'))
       <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" arial-label="Close"><span aria-hidden="true">x</span></button>
             {{ Session::get('message') }}
        </div>
       @endif
    </div>
  </div>
  <table class="table table-bordered">
    <thead>
      <tr>
        <td>Id</td>
        <td>Title</td>
        <td>Description</td>
        <td>Price</td>

      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
        <tr>
          <td><a href="{{route('products.show', $product)}}">{{ $product->id }}</a></td>
          <td><a href="{{route('products.show', $product)}}">{{ $product->title }}</a></td>
          <td>{{ $product->description }}</td>
          <td>{{ $product->pricing }}</td>
          <td class="text-right actions">
            <a href="{{route('products.edit', $product)}}" class="btn btn-info">edit</a>
            <form class="form-inline" method="post"
            action="{{route('products.destroy', $product)}}"
            onsubmit="return confirm('Sure?')">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="delete" class="btn btn-danger">
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

</div>
<div class="floating">
  <a href="{{ url('/products/create') }}" class="btn btn-primary btn-fab">
    <i class="material-icons">+</i>
  </a>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    var hola ="hola";
    console.log(hola);
    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
      });
    }, 2000);
  });

</script>
@endsection
