<?php

namespace App\Http\Controllers\API;

use App\Events\ProductCreated;
use App\Exceptions\ProductStoreQueryException;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductStoreRequestHandler;
use App\Service\ProductStore;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Handling "New Product Request" (alias: ProductStore).
 */
final class ProductsController
{
    /**
     * @var ProductStore DatabaseStore for entity "Product" objects.
     */
    private ProductStore $store;

    /**
     * @var ProductStoreRequestHandler
     */
    private ProductStoreRequestHandler $handler;

    /**
     * ProductsController constructor.
     *
     * @param ProductStore               $store   Service to save Product
     * @param ProductStoreRequestHandler $handler Service to change HTTPRequest to Product object
     */
    public function __construct(ProductStore $store, ProductStoreRequestHandler $handler)
    {
        $this->store = $store;
        $this->handler = $handler;
    }

    // only to mark validation (this comment shouldn't be added to git repository)
    // input validation was done by laravel, JsonResponse::HTTP_UNPROCESSABLE_ENTITY is returned if
    // input data is not valid, and body contain validation errors.
    public function create(ProductStoreRequest $request): Response
    {
        $product = $this->handler->handle($request);

        try {

            $this->store->store($product);

            event(new ProductCreated($product));

        } catch (ProductStoreQueryException $exception) {
            return new JsonResponse(["message" => "Database query failed."], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        // this lines should be deleted - in non debug env, Laravel take care of all other exceptions
        } catch (\Exception $anyOtherException) {
            return new JsonResponse(["message" => "Internal server Error."], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['product' => $product], JsonResponse::HTTP_CREATED);
    }
}
