<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;

/**
 * Exception when price < 0.
 */
class InvalidPriceException extends \InvalidArgumentException
{
}
