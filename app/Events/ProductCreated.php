<?php

namespace App\Events;

use App\Models\Product;

/**
 * Simple Event that ocurs when new Product entity is succesfully created (either by Form or Api or Command).
 */
class ProductCreated
{
    /**
     * @var Product the one, that was just created. ReadOnly.
     */
    private Product $product;

    /**
     * Create a new event instance.
     *
     * @param Product $product Newly created product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Returns clone of product that was created.
     *
     * @return Product
     */
    public function getProduct(): Product
    {
        return clone $this->product;
    }
}
