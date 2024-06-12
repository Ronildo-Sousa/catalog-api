<?php

namespace App\DataTransferObjects;

use App\Contracts\DTOInterface;
use Illuminate\Http\Request;

class CategoryDTO implements DTOInterface
{
    public readonly ?int $id;

    public function __construct(
        $id = null,
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?string $owner_id,
    ){
        $this->id = $id;   
    }

    public static function from(array|Request $data): self
    {
        if ($data instanceof Request) {
            $data = $data->toArray();
        }

        return new CategoryDTO(
            id: data_get($data, 'id'),
            title: data_get($data, 'title'),
            description: data_get($data, 'description'),
            owner_id: data_get($data, 'owner_id')
        );
    }

    public function toArray(): array
    {
        return (array)$this;
    }
}


