<?php


namespace App\services;

use App\main\App;

class GoodServices
{
    public function getOptions($data)
    {
        $category = (!empty($data["category"])) ? $data["category"] : 0;
        $size = (!empty($data["size"])) ? implode($data["size"], "','") : null;
        $price = (!empty($data["price"])) ? $data["price"] : 0;

        $sort = (!empty($data["sort"])) ? $data["sort"] : "count_desc";
        $sort = explode('_', $sort);
        $sortBy = $sort[0];
        $sortDir = $sort[1];

        return $options = [
            "category" => $category,
            "size" => $size,
            "price" => $price,
            "sortBy" => $sortBy,
            "sortDir" => $sortDir
        ];
    }

    public function getSql($options, $user)
    {
        $category = $options["category"];
        $size = $options["size"];
        $price = $options["price"];
        $sortBy = $options["sortBy"];
        $sortDir = $options["sortDir"];

        $categoryWhere =
            ($category !== 0)
                ? "category = '$category' and "
                : "";

        $brandsWhere =
            ($size !== null)
                ? "size in ('$size') and "
                : "";

        if ($user["role"] === "isAdmin") {
            $sql = "SELECT * FROM gallery WHERE $categoryWhere $brandsWhere
                    price BETWEEN '0' AND '$price' ORDER BY $sortBy $sortDir";
        } else {
            $sql = "SELECT * FROM gallery WHERE stock = '1' AND $categoryWhere $brandsWhere
                    price BETWEEN '0' AND '$price' ORDER BY $sortBy $sortDir";
        }
        return $sql;
    }

    public function changeGood($data)
    {
        $good = App::call()->goodRepository->newEntity($data);
        App::call()->goodRepository->save($good);
    }

    public function copyFile()
    {
        $file = PUBLIC_DIR . "/img/{$_FILES['userfile']['name']}";
        copy($_FILES['userfile']['tmp_name'], $file);
    }
}