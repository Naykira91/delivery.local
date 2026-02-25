<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;

class Product extends Model
{
    protected $fillable = [
        'type','name','slug','description','composition',
        'weight_grams','pieces','price','is_active'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)
            ->withPivot('sort')
            ->orderBy('category_product.sort');
    }

    /**
     * Если этот продукт — СЕТ, то так достаём содержимое
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function setItems()
    {
        return $this->hasMany(SetItem::class, 'set_id')->orderBy('sort');
    }

    // Удобнее: сразу продукты, входящие в сет (роллы/закуски)
    public function items()
    {
        return $this->belongsToMany(Product::class, 'set_items', 'set_id', 'product_id')
            ->withPivot(['qty','sort'])
            ->orderBy('set_items.sort');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort');
    }

    public function mainImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_main', true);
    }

    /**
     * Удобно: получить картинку для карточки
     * (главная -> первая по sort -> null)
     */
    public function getCardImagePathAttribute(): ?string
    {
        if ($this->relationLoaded('mainImage') && $this->mainImage) {
            return $this->mainImage->path;
        }

        // если mainImage не подгружен, попробуем найти из images
        if ($this->relationLoaded('images') && $this->images->isNotEmpty()) {
            $main = $this->images->firstWhere('is_main', true);
            return ($main?->path) ?? $this->images->sortBy('sort')->first()->path;
        }

        return null;
    }
}
