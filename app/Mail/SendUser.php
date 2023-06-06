<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendUser extends Mailable
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
        return $this->view('admin.pages.sendmail')
            ->from('dn5678853@gmail.com', '[HUST]-Unimart')
            ->subject('[HUST-UNIMART] Đã Phản Hồi Thông Tin Và Những Câu Hỏi Thắc Mắc Của Bạn')
            ->with($this->data);
   
        }
}
