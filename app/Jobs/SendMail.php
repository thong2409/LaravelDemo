<?php

namespace App\Jobs;

use App\Mail\OrderShipper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email;
    protected $orderData;
    /**
     * Create a new job instance.
     */
    public function __construct($email,$orderData)
    {
        $this->email = $email;
        $this->orderData = $orderData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new OrderShipper($this->orderData));
    }
}
