<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
Use Illuminate\Foundation\Queue\InteractsWithQueue;
Use Illuminate\Foundation\Queue\SerializesModels;
Use Illuminate\Foundation\Bus\Dispatchable;
Use Iluminate\Supports\Facades\Mail;
Use App\Mail\WelcomeMail;
Use App\Models\User;

class SendWelcomeMail implements ShouldQueue
{
    use Dispatchable,InteractsWithQueue,Queueable,SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user=$user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email->sene(new WelcomeMail($this->user)));
    }
}
