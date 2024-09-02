<?php

namespace App\Jobs;

use App\Helper\Logger;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
// use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use App\Jobs\MyEmailService;
use Illuminate\Mail\Message;

class ServerEmail implements ShouldQueue
{
    use Queueable,Dispatchable,InteractsWithQueue,SerializesModels;

    /**
     * Create a new job instance.
     */
    public $timeout = 120;
    protected $email;

    public function __construct($email)
    {
        $this->email = $email;
    }
   

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data =$this->email;
        if($this->email){
            Logger::info('ServerEmail', ['email' => $this->email]);
            //  new Envelope(from: new Address('gn0039625@crepowermay.com'),subject:'yes laravel email', to: new Address('gn0039625@gmail.com'));
            //  $env = new Envelope(
            //     from: new Address('gn0039625@gmail.com', 'Jeffrey Way'),
            //     subject: '訂單發貨',
            // );
            //  Mail::to('gn0039625@gmail.com')->send(new EmailService($env));
            //  Mail::send('mail',$data,function($message) use ($data){
            //      $message->from('jason', 'gn0039625@crepowermay.com', $data);
            //      $message->to('gn0039625@gmail.com')->subject('yes laravel email');
            //  });

            //  Mail::send('mail', $data, function ($message) use ($data) {
            //     $message->from(ENV('jason', 'gn0039625@crepowermay.com'), $data);
            //     $message->to(ENV('gn', 'gn0039625@gmail.com'))->subject('yes laravel email');
            // });
           
            // Mail::to('receiver@example.com')->queue(new MyEmailService($data));
             Mail::send('welcome', [], function (Message $message) {
                 $message->sender('gn0039625@crepowermay.com');
                 $message->subject('Laravel 5.2 mail by Queue');
                 $message->to($this->email);
             });


            Logger::info('ServerEmail', ['email' => 'yes email']);
        }
        else{
            Logger::info('ServerEmail', ['email' => 'no email']);
        }
    }
}
