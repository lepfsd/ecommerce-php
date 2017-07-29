<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta charset="utf-8">
  </head>
  <body>
    <h1>hola!</h1>
    <p>datos de su compra</p>
    <br>
    <table>
      <thead>
        <tr>
          <th>Producto</th>
          <th>costo</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
        <tr>
          <td>{{$product->title}}</td>
          <td>{{$product->pricing}}</td>
        </tr>
        <tr>
          <td>Total</td>
          <td>{{$order->total}}</td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
