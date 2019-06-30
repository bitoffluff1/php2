<?php

namespace App\models\repositories;

use App\main\App;
use App\models\entities\Review;

class ReviewRepository extends Repository
{
    public function getTableName(): string
    {
        return "reviews";
    }

    protected function getEntityClass()
    {
        return Review::class;
    }


    public function getGoodReviews($id_product)
    {
        $sql = "SELECT * FROM reviews WHERE id_product = :id_product ORDER BY id DESC";
        return App::call()->db->getObjects($sql, $this->getEntityClass(), [":id_product" => $id_product]);
    }
}