<?php

namespace App\DataTransferObjects;

use App\Contracts\DTOInterface;
use Illuminate\Http\Request;

class CategoryDTO implements DTOInterface
{
    public function __construct(
        public readonly ?string $title,
        public readonly ?string $description
    ){}

    public static function from(array|Request $data): self
    {
        if ($data instanceof Request) {
            $data = $data->toArray();
        }

        return new CategoryDTO(
            title: data_get($data, 'title'),
            description: data_get($data, 'description')
        );
    }

    public function toArray(): array
    {
        return (array)$this;
    }
}


