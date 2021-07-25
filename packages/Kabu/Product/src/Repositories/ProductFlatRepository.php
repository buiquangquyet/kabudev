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

    function getHomeProductByCategory($category, $count = false)
    {
       
        if ($count == false)
            $count = core()->getConfigData('catalog.products.homepage.no_of_featured_product_homepage');
        return app('Webkul\Product\Repositories\ProductFlatRepository')->categoryProductQuerybuilder($category)->limit($count)->get();
    }
}
