<?php


namespace App\services;

use App\main\App;

class GoodServices
{
    public function getSql($request)
    {
        $sql = "SELECT * FROM gallery WHERE stock = '1'";

        $sort = $request->getParams("get", "sort");
        if (!empty($sort)) {
            if ($sort === "popularity") {
                $sql .= "ORDER BY gallery.count DESC";
            } else if ($sort === "name") {
                $sql .= "ORDER BY gallery.name ASC";
            }
        }

        return $sql;
    }

    public function changeGood($data){
        $good = App::call()->goodRepository->newEntity($data);
        App::call()->goodRepository->save($good);
    }

    public function copyFile(){
        $file = PUBLIC_DIR . "/img/{$_FILES['userfile']['name']}";
        copy($_FILES['userfile']['tmp_name'], $file);
    }
}