<?php

namespace App\models\repositories;

use App\models\entities\Cart;

/**
 * Class GoodRepository
 * @package App\models
 *
 * @method Cart getOne($id)
 */
class CartRepository extends Repository
{
    public function getTableName(): string
    {
        return "gallery";
    }

    protected function getEntityClass()
    {
        return Cart::class;
    }
}