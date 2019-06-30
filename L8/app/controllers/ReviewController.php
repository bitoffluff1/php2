<?php

namespace App\controllers;

use App\main\App;

class ReviewController extends Controller
{
    protected $defaultAction = "reviews";

    public function reviewsAction()
    {
        $params = [
            "reviews" => App::call()->reviewRepository->getAll("SELECT * FROM reviews ORDER BY reviews.date DESC"),
            "user" => $this->checkUser(),
        ];

        echo $this->render("review", $params);
    }

    public function addAction()
    {
        $params = $this->request->getParams("post");
        foreach ($params as $value) {
            if (empty($value)) {
                $this->redirect();
            }
        }

        $review = App::call()->reviewRepository->newEntity($params);
        App::call()->reviewRepository->save($review);

        $this->redirect();
    }

    public function deleteAction(){
        $this->isAdmin();

        $review = App::call()->reviewRepository->newEntity(["id" => $this->getId()]);
        App::call()->reviewRepository->delete($review);

        $this->redirect();
    }
}