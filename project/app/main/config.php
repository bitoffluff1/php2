<?php

return [
    "name" => "Магазин",
    "defaultAction" => "goods",

    "components" => [
        "db" => [
            "class" => \App\services\Db::class,
            "config" => [
                "driver" => "mysql",
                "db" => "gbphp",
                "host" => "localhost",
                "user" => "root",
                "password" => "",
                "charset" => "utf8"
            ],
        ],
        "render" => [
            "class" => \App\services\renders\TwigRender::class,
        ],
        "userRepository" => [
            "class" => \App\models\repositories\UserRepository::class,
        ],
        "goodRepository" => [
            "class" => \App\models\repositories\GoodRepository::class,
        ],
        "orderRepository" => [
            "class" => \App\models\repositories\OrderRepository::class,
        ],
        "reviewRepository" => [
            "class" => \App\models\repositories\ReviewRepository::class,
        ],
        "cartServices" => [
            "class" => \App\services\CartServices::class,
        ],
        "authServices" => [
            "class" => \App\services\AuthServices::class,
        ],
        "goodServices" => [
            "class" => \App\services\GoodServices::class,
        ],
        "orderServices" => [
            "class" => \App\services\OrderServices::class,
        ],
    ],
];
