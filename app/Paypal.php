<?php
namespace App;

class Paypal
{
  private $_apiContext;
  private $shopping_cart;
  private $_ClientId = 'AWRovrYK7zlfYzLNtpYjdvBgobWoFf4ifhst2yUyxkAcDnPxbcPh7i1kltmP3qYauJ1GkjMkghjABwgO';
  private $_ClientSecret = 'EEyg9XFlfnVw4u5NsAN1v1lGyI9d092QQ2yrndBLqoQyOkZ3DL9kuuqXzjcEsGUL1PJewcCHHrNge1eY';

  public function __construct($shopping_cart){

    $this->_apiContext = \PaypalPayment::ApiContext($this->_ClientId, $this->_ClientSecret);
    $config = config("paypal_payment");
    $flatConfig = array_dot($config);
    $this->_apiContext->setConfig($flatConfig);
    $this->shopping_cart = $shopping_cart;
  }

  public function generate(){

    $payment = \PaypalPayment::payment()->setIntent("sale")
                        ->setPayer($this->payer())
                        ->setTransactions([$this->transaction()])
                        ->setRedirectUrls($this->redirectURLs());

    try{
      $payment->create($this->_apiContext);
    } catch(\Exception $ex){
      //dd($ex);
      exit(1);
    }
    return $payment;
  }

  public function payer(){
    return \PaypalPayment::payer()
              ->setPaymentMethod("paypal");
  }

  public function transaction(){

    return \PaypalPayment::transaction()
                  ->setAmount($this->amount())
                  ->setItemList($this->items())
                  ->setDescription("Tu compra en ProductosFacilito")
                  ->setInvoiceNumber(uniqid());
  }

  public function items(){

    $items = [];
    $products = $this->shopping_cart->products()->get();

    foreach($products as $product){
      array_push($items, $product->paypalItem());
    }

    return \PaypalPayment::itemList()->setItems($items);
  }

  public function amount(){
    return \PaypalPayment::amount()
            ->setCurrency("USD")->setTotal($this->shopping_cart->totalUSD());
  }

  public function redirectURLs(){

    $baseURL = url('/');
    return \PaypalPayment::redirectURLs()
              ->setReturnUrl("$baseURL/payments/store")
              ->setCancelUrl("$baseURL/carrito");
  }

  public function execute($paymentId, $PayerID){

    $payment = \PaypalPayment::getById($paymentId, $this->_apiContext);
    $execution = \PaypalPayment::PaymentExecution()
                          ->setPayerId($PayerID);
    return $payment->execute($execution, $this->_apiContext);
  }

}
