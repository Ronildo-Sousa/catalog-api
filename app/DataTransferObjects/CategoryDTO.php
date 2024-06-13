<?php

namespace App\DataTransferObjects;

use Illuminate\Http\Request;

class CategoryDTO extends AbstractDTO
{
    public function __construct(
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?string $owner_id,
    ) {}

    public static function from(array|Request $data): self
    {
        if ($data instanceof Request) {
            $data = $data->toArray();
        }

        return new self(
            title: data_get($data, 'title'),
            description: data_get($data, 'description'),
            owner_id: data_get($data, 'owner_id')
        );
    }
}
