<?php

namespace Kabu\Product\Models;

use Webkul\Product\Models\ProductFlat  as ProductFlatBaseModel;

class ProductFlat extends ProductFlatBaseModel
{
    /**
     * The related products that belong to the product.
     */
    public function related_products(int $limit = 4)
    {
        return $this->product->related_products($limit);
    }

    /**
     * The up sells that belong to the product.
     */
    public function up_sells(int $limit = 4)
    {
        return $this->product->up_sells($limit);
    }

    /**
     * The cross sells that belong to the product.
     */
    public function cross_sells(int $limit = 4)
    {
        return $this->product->cross_sells($limit);
    }
}
