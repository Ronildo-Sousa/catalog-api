<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'owner_id',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => ($value / 100),
            set: fn (float $value) => ($value * 100),
        );
    }
}
