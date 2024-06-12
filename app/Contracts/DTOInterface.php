<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface DTOInterface 
{
    public static function from(array|Request $data): self;

    public function toArray(): array;
}
