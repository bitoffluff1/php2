<?php

namespace App\models\repositories;

use App\models\entities\User;

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

    public function getUser($login)
    {
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table} WHERE login= :login";
        return $this->db->getObject($sql, $this->getEntityClass(), [":login" => $login]);
    }

    public function newUser($login, $password, $role = "")
    {
        $user = new User($login, $password);
        $user->login = $login;
        $user->password = $password;
        if (!empty($role)) {
            $user->role = $role;
        }

        $this->save($user);
        return $user;
    }
}