<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckOut extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
        //

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('clients.email.sendmail')
            ->from('dn5678853@gmail.com', '[HUST]-Unimart')
            ->subject('[HUST-UNIMART] Thông Tin Đơn Hàng Của Bạn !')
            ->with($this->data);
    }
}
