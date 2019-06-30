<?php

namespace App\models\repositories;
;

use App\models\entities\Good;

/**
 * Class GoodRepository
 * @package App\models
 *
 * @method Good getOne($id)
 */
class GoodRepository extends Repository
{
    public function getTableName(): string
    {
        return "gallery";
    }

    protected function getEntityClass()
    {
        return Good::class;
    }

}