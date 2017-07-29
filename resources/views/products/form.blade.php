{!! Form::open(array('url' => $url, 'method' => $method, 'files' => true)) !!}
<div class="row">
  <div class="col-md-4">
    <div class="form-group{{ $errors->has('title') ? 'has-error' : '' }}">
        <label for="">title</label>
        {{ Form::text('title',$product->title,['class'=>'form-control']) }}
        <small class="text-danger">{{ $errors->first('title') }}</small>
    </div>
    <div class="form-group{{ $errors->has('pricing') ? 'has-error' : ''}}">
      <label for="">pricing</label>
      {{ Form::number('pricing', $product->pricing,['class'=>'form-control']) }}
      <small class="text-danger">{{ $errors->first('pricing') }}</small>
    </div>
    <div class="form-group">
      {{ Form::file('cover') }}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group{{ $errors->has('description') ? 'has-error' : ''}}">
        <label for="">description</label>
        {{ Form::textarea('description',$product->description,['class'=>'form-control','size' => '30x5'])}}
        <small class="text-danger">{{ $errors->first('description')}}</small>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3 pull-right">
    <div class="form-group text-right">
        <a href="{{ url('/products') }}" class="btn btn-info">Back</a>
        <input type="submit" value="submit" class="btn btn-success">
    </div>
  </div>
</div>
{!! Form::close() !!}
