<?php

namespace App\Service;

use App\Exceptions\ProductStoreQueryException;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

/**
 * Saves product object in database.
 */
class ProductStore
{
    /**
     * ProductStore constructor.
     *
     * Should have some database connection/orm to handle saveing, but Laravel has it's own way.
     */
    public function __construct(/** ConnectionWrapper $dbal */ /* , EventSourcingLogger $esLogger */ )
    {
    }

    /**
     * Inserting product to database.
     *
     * @param Product $product
     *
     * @return bool
     */
    public function store(Product $product): bool
    {
        $retval = true;

        try {

            // logic in most cases have more inserts.
            DB::beginTransaction();
            DB::insert("INSERT INTO products (name, price) VALUES (?, ?)", [$product->getName(), $product->getPrice()]);

            // save log about successful product creation
            // $this->esLogger->store();

            DB::commit();

        } catch(QueryException $e) {
            // maybe some fancy checking on cause (duplicate key, wrong name, other database error)
            throw new ProductStoreQueryException($e->getSql(), $e->getBindings(), $e);
        }

        return $retval;
    }
}
