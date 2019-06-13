<?php

namespace App\traits;

trait Calc
{
    public function getCount($param)
    {
        return count($param);
    }

}