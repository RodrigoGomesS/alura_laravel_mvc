<?php

namespace App\Listeners;

use App\Events\SeriesDeleted;
use App\Mail\SeriesDeleted as MailSeriesDeleted;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailUserAboutSeriesDeleted implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SeriesDeleted  $event
     * @return void
     */
    public function handle(SeriesDeleted $event)
    {
        //busca todos os usuarios
        $users =  User::all();

        foreach ($users as $index => $user) {

            //cria o email, passando os parametros
            $email = new MailSeriesDeleted(
                $event->seriesName,
            );

            //add Assunto
            $email->subject('Série deletada');

            $when = now()->addSeconds($index * 5);

            //Enviar email
            Mail::to($user)->later($when, $email);
        }
    }
}
