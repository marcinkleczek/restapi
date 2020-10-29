<?php

namespace App\Listeners;

use App\Events\ProductCreated;

/**
 * After creating new Product, some googled photo should be downloaded for it.
 * Silly task, only to check event processing.
 */
class ProductCreatedDownloadPhoto
{
    /**
     * Create the event listener.
     */
    public function __construct( /*
        SomeGoogleImagesSearchingService $googleImService,
        SomeHTTPDownloaderService $curl,
        ProductImagesService $pis
        */ )
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
        // $product = $event->getProduct();
        // $url = $this->googleImService->findFirstPhoto($product->getName());
        // $image = $curl->getImageResource($url);
        // $pis->saveProductPhotoFromResource($product, $image);
        // $logger->debug("Product photo for newly created $product was downloaded.");
    }
}
