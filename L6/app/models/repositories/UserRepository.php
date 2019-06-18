<?php

namespace App\models\repositories;

use App\models\entities\User;

/**
 * Class UserRepository
 * @package App\models\repositories
 *
 * @method User getOne($id)
 */
class UserRepository extends Repository
{
    public function getTableName(): string
    {
        return "users";
    }

    protected function getEntityClass()
    {
        return User::class;
    }
}