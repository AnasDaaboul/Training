<?php

namespace App\Listeners;

use App\Events\CheckOTpEvent;
use App\Events\PurchaseEvent;
use App\Mail\LoginOrSignupEmail;
use Illuminate\Events\Dispatcher;
use App\Events\LoginOrSignupEvent;
use App\Mail\OtpEmail;
use App\Mail\PurchaseEmail;
use Illuminate\Support\Facades\Mail;


class SendEmailListener
{
    /**
     * Handle the event.
     */
    public function handleUserLogin(LoginOrSignupEvent $event): void
    {
        Mail::to($event->userEmail)->send(new LoginOrSignupEmail($event->userEmail,$event->message));
    }

    public function handleUserPurchase(PurchaseEvent $event): void
    {
        Mail::to($event->userEmail)->send(new PurchaseEmail($event->userEmail,$event->message));
    }
    public function handleOtp(CheckOTpEvent $event): void
    {
        Mail::to($event->userEmail)->send(new OtpEmail($event->userEmail,$event->message , $event->otp));
    }


    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            LoginOrSignupEvent::class,
            [SendEmailListener::class, 'handleUserLogin']
        );

        $events->listen(
            PurchaseEvent::class,
            [SendEmailListener::class, 'handleUserPurchase']
        );
        $events->listen(
            CheckOTpEvent::class,
            [SendEmailListener::class, 'handleOtp']
        );
    }
}
