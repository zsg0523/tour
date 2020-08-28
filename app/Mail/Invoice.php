<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;

    protected  $order;
    public  $view;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $view)
    {
        $this->order = $order;
        $this->view = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->markdown($this->view)
                    ->with([
                        'no' => $this->order->no,
                        'created_at' => $this->order->created_at,
                        'items' => $this->order->items,
                        'remark' => $this->order->remark,
                        'total_amount' => $this->order->total_amount,
                        'extra' => $this->order->extra,
                        'address' => $this->order->address,
                    ]);
    }
}
