<?php
namespace App\services\renders;


class TmplRender implements IRender
{
    public function render( $template,$params){
        ob_start();
        extract($params);
        include $_SERVER["DOCUMENT_ROOT"] . "/../views/" . $template . ".php";
        return ob_get_clean();
    }
}