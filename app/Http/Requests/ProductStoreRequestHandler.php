<?php

namespace App\Http\Requests;

use App\Models\Product;

/**
 * Handles Product object creation from Request. Can be used to fullfill additional data injection.
 */
class ProductStoreRequestHandler
{
    /**
     * ProductStoreRequestHandler constructor.
     *
     * Should handle additional services that must be used to create Product object from HTTP Request.
     */
    public function __construct(/* SomeRepository $repo */)
    {
    }

    /**
     * Creating destintion Product object based on request and additional services (if need).
     *
     * @param ProductStoreRequest $request HTTP Request to handle
     *
     * @return Product
     */
    public function handle(ProductStoreRequest $request): Product
    {
        $product = new Product();
        $product->fromArray($request->all());

        // additional data injection to object:
        // $product->setWarehouseQuantity($this->repo->getWarehouseQuantity($product);

        return $product;
    }
}
