<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SendMail
{
    public function __construct()
    {
    }

    public function sendMail($entity)
    {
        $emailAdmin = $_ENV['EMAIL_ADMIN'];
//    dd($entity);
//        dd($emailAdmin);
//        $email = (new Email())
//            ->from('hello@example.com')
//            ->to('you@example.com')
//            //->cc('cc@example.com')
//            //->bcc('bcc@example.com')
//            //->replyTo('fabien@example.com')
//            //->priority(Email::PRIORITY_HIGH)
//            ->subject('Time for Symfony Mailer!')
//            ->text('Sending emails is fun again!')
//            ->html('<p>See Twig integration for better HTML integration!</p>');
//
//        $this->mailer->send($email);
    }
}