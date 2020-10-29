<?php

namespace App\Models;

use App\Exceptions\InvalidPriceException;

/**
 * Simple Product class represents model from Database... etc etc
 */
class Product implements \JsonSerializable
{
    /**
     * UUID can be used if need
     *
     * @var int
     */
    protected $id;

    /**
     * @var string Product name
     */
    protected $name = '';

    /**
     * Product gross price.
     *
     * @var float For such simple task we'll use one float variable. But in real it depends on business needs.
     */
    protected $price = 0.0;

    /**
     * @mkk Laravel Model like behavior
     *
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
    ];

    /**
     * @return string Represents object as string to be read by humans.
     */
    public function __toString()
    {
        // number_format should be changed to some external call which format currency values to one - common app format.
        return sprintf("%s ($%s)", $this->name, number_format($this->price, 2, ',', ' '));
    }

    /**
     * Filling $fillable attributes in this object from passed $array with proper setters;
     *
     * @param array $array Flat array with data to be replaced in this object.
     *
     * @return $this
     */
    public function fromArray(array $array): self
    {
        foreach ($this->fillable as $key) {
            $setter = 'set'.$key;
            if (array_key_exists($key, $array) && method_exists($this, $setter)) {
                $this->$setter($array[$key]);
            }
        }

        return $this;
    }

    /**
     * In case if some fields shouldn't be send to JS.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'name'  => $this->name,
            'id'    => $this->id,
            'price' => $this->price,
        ];
    }

    /**
     * Setting product new name (should have some validation/escape etc)
     *
     * @param string $name New name of product.
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param float $price New price to set
     *
     * @return self
     */
    public function setPrice(float $price): self
    {
        if ($price < 0) {
            throw new InvalidPriceException("Product price shouldn't be under 0");
        }

        // this should be changed to bussiness decistion about prices
        $this->price = round($price, 6);

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }
}
