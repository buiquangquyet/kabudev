<?php

namespace Kabu\Product\Repositories;

use Webkul\Core\Eloquent\Repository;

class ProductFlatRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Webkul\Product\Contracts\Product';
    }

    function getHomeProductByCategory($category)
    {
        return app('Webkul\Product\Repositories\ProductFlatRepository')->categoryProductQuerybuilder($category)->limit(6)->get();
    }
}
