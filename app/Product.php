<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Связь с категориями товаров.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Обновление товара вместе с привязкой к категориям.
     *
     * @param $productAttrs
     * @param $categoryIds
     * @return $this
     */
    public function updateWithRelations($productAttrs, $categoryIds)
    {
        DB::transaction(function () use ($productAttrs, $categoryIds) {
            $this->update($productAttrs);
            $this->categories()->sync($categoryIds);
        });
        return $this;
    }

    /**
     * Создание товара вместе с привязкой к категориям.
     *
     * @param $productAttrs
     * @param $categoryIds
     * @return $this
     */
    public function createWithRelations($productAttrs, $categoryIds)
    {
        DB::transaction(function () use ($productAttrs, $categoryIds) {
            $this->fill($productAttrs);
            $this->save();
            $this->categories()->sync($categoryIds);
        });
        return $this;
    }
}
