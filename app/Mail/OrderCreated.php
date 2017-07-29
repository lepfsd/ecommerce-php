<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $products;


    /**
     * Create a new message.
     *
     * @return $void
     */
     public function __construct($order){

       $this->order = $order;
       $this->products = $order->shopping_cart->products()->get();
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('eperez100134@gmail.com')->view('mailers.order');
    }
}
