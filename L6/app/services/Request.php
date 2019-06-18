<?php


namespace App\services;


class Request
{
    private $requestString;
    private $controllerName;
    private $actionName;
    private $params;
    private $gets;

    public function __construct()
    {
        $this->requestString = $_SERVER["REQUEST_URI"];
        $this->parseRequest();
    }

    /**
     * @return mixed
     */
    public function getRequestString()
    {
        return $this->requestString;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    public function getGets()
    {
        return $this->gets;
    }

    public function parseRequest()
    {
        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";

        if (preg_match_all($pattern, $this->requestString, $matches)) {
            $this->controllerName = $matches["controller"][0];
            $this->actionName = $matches["action"][0];

            $params = explode("=", $matches["params"][0]);
            $this->gets[$params[0]] = $params[1];

            $this->params["post"] = $_POST;
            //$this->params["get"] = $_GET;
        }
    }
}