<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mail\OrderCreated;
use Illuminate\Support\Facades\Mail;

class Order extends Model
{
    protected $fillable = ['shopping_cart_id','line1','line2', 'city', 'postal_code', 'country_code', 'state', 'recipient_name', 'email',
                            'status', 'guide_number', 'total'];

    public static function createFromPayPalResponse($response, $shopping_cart){

      $payer = $response->payer;

      $orderData = (array) $payer->payer_info->shipping_address;
      $orderData = $orderData[key($orderData)];
      $orderData["email"] = $payer->payer_info->email;
      $orderData["total"] = $shopping_cart->total();
      $orderData["shopping_cart_id"] = $shopping_cart->id;

      return Order::create($orderData);
    }

    public function address(){
      return "$this->line1 $this->line2";
    }

    public function scopeLatest($query){
      return $query->orderID()->monthly();
    }

    public function scopeOrderID($query){
      return $query->orderBy('id', 'desc');
    }

    public function scopeMonthly($query){
      return $query->whereMonth('created_at','=',date('m'));
    }

    public static function totalMonth(){
      return Order::monthly()->sum("total");
    }

    public static function totalMonthCount(){
      return Order::monthly()->count();
    }

    public function shopping_cart(){

      return $this->belongsTO('App\ShoppingCart');
    }

    public function sendMail(){

      Mail::to("lep.fsd@live.com")->send(new OrderCreated());
    }

    public function shoppingCartID(){

      return $this->shopping_cart->customid;
    }

}
