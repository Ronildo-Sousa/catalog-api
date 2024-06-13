<?php

namespace App\DataTransferObjects;

use App\Contracts\DTOInterface;
use Illuminate\Http\Request;

abstract class AbstractDTO implements DTOInterface
{
    public static function from(array|Request $data): self
    {
        return new self;
    }

    public function toArray(): array
    {
        return get_object_vars($this);   
    }
}