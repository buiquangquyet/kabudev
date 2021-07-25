<?php

namespace Kabu\Product\Models;

use Webkul\Product\Models\Product as ProductBaseModel;

class Product extends ProductBaseModel
{

    /**
     * The related products that belong to the product.
     * @var int $limit set number of products to get, -1 to get all
     */
    public function related_products(int $limit = 4)
    {
        return $this->belongsToMany(static::class, 'product_relations', 'parent_id', 'child_id')->limit($limit);
    }

    /**
     * The up sells that belong to the product.
     * @var int $limit set number of products to get, -1 to get all
     */
    public function up_sells(int $limit = 4)
    {
        return $this->belongsToMany(static::class, 'product_up_sells', 'parent_id', 'child_id')->limit($limit);
    }

    /**
     * The cross sells that belong to the product.
     * @var int $limit set number of products to get, -1 to get all
     */
    public function cross_sells(int $limit = 4)
    {
        return $this->belongsToMany(static::class, 'product_cross_sells', 'parent_id', 'child_id')->limit($limit);
    }
}
