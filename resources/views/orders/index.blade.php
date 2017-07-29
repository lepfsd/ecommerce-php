@extends("layouts.app")

@section("content")
<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2>Dashboard</h2>
    </div>
    <div class="panel-body">
      <h3>Estadisticas</h3>
      <div class="row top-space">
        <div class="col-xs-4 col-md-3 col-lg-2 sale-data">
          <span>{{$totalMonth}}USD</span> Ingresos del mes
        </div>
        <div class="col-xs-4 col-md-3 col-lg-2 sale-data">
          <span>{{$totalMonthCount}}</span> Numero de ventas
        </div>
      </div>
      <h3>Ventas</h3>
      <table class="table table-bordered">
        <thead>
          <tr>
            <td>ID. Venta</td>
            <td>Comprador</td>
            <td>Dirección</td>
            <td>No. guía</td>
            <td>Status</td>
            <td>Fecha de venta</td>
            <td>Acciones</td>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
            <tr>
              <td>{{$order->id}}</td>
              <td>{{$order->recipient_name}}</td>
              <td>{{$order->address()}}</td>
              <td>
                <a href="#"
                   data-type="text"
                   data-pk="{{$order->id}}"
                   data-url="{{url('/orders/$order->id')}}"
                   data-title="Numero de guia"
                   data-value="{{$order->guide_number}}"
                   data-name="guide_number"
                   class="set-guide-number">
                </a>
              </td>
              <td>
                <a href="#"
                   data-type="select"
                   data-pk="{{$order->id}}"
                   data-url="{{url('/orders/$order->id')}}"
                   data-title="status"
                   data-value="{{$order->status}}"
                   data-name="status"
                   class="set-select-status">
                </a>
              </td>
              <td>{{$order->created_at}}</td>
              <td>acc</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
