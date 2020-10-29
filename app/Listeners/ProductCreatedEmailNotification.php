<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use Psr\Log\LoggerInterface;

/**
 * After new product was created, we should email Finance Department to check/set prices for it.
 */
class ProductCreatedEmailNotification
{
    /**
     * Should have real services to send an email.
     *
     * @return void
     */
    public function __construct(/*
        array $emails,
        AnyMailingService $transport,
        AnyBodyGenerateingService $twig,
        LoggerInterface $logger
    */)
    {
        // assign internal variables
    }

    /**
     * Handle the event.
     *
     * @param  ProductCreated $event
     * @return void
     */
    public function handle(ProductCreated $event)
    {
        // $email = $this->twig->render('@someTemplate', ['product' => $event->getProduct()]);
        // $this->transport->send($emails, $htmlbody);
        // $logger->info("Email Notification about new product $product was sent to ...");
    }
}
