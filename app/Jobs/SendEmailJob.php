<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageAltaOperacion;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $destinatario;
    protected $mail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($destinatario, $mail)
    {
        //
        $this->destinatario = $destinatario;
        $this->mail = $mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        try{
            Mail::to($this->destinatario)->send($this->mail);
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }

    }
}
