<?php

namespace App\Observers;

use App\Models\Mail;
use Illuminate\Support\Facades\Mail as MailFacade;

class MailObserver
{
    /**
     * Handle the Mail "created" event.
     *
     * @param Mail $mail
     * @return void
     */
    public function created(Mail $mail)
    {
        MailFacade::send('mails.observer', ['message' => $mail->content], function ($message) use($mail){
            $message->from($mail->from);
            $message->to($mail->to);
            $message->subject($mail->subject);
        });
    }

    /**
     * Handle the Mail "updated" event.
     *
     * @param Mail $mail
     * @return void
     */
    public function updated(Mail $mail)
    {
        //
    }

    /**
     * Handle the Mail "deleted" event.
     *
     * @param Mail $mail
     * @return void
     */
    public function deleted(Mail $mail)
    {
        //
    }

    /**
     * Handle the Mail "restored" event.
     *
     * @param Mail $mail
     * @return void
     */
    public function restored(Mail $mail)
    {
        //
    }

    /**
     * Handle the Mail "force deleted" event.
     *
     * @param Mail $mail
     * @return void
     */
    public function forceDeleted(Mail $mail)
    {
        //
    }
}
