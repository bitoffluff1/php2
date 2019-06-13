<?php


namespace App\traits;


trait TController
{
    private $action;

    public function run($action)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = $this->action . "Action";
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo "404";
        }
    }

    public function render($template, $params = [])
    {
        $content = $this->renderTmpl($template, $params);
        return $this->renderTmpl("layouts/main", ["content" => $content]);
    }

    /**
     * @param $template
     * @param array $params ["name" => "user"]
     * @return
     */
    public function renderTmpl($template, $params = [])
    {
        ob_start();
        extract($params);
        include $_SERVER["DOCUMENT_ROOT"] . "/../views/" . $template . ".php";
        return ob_get_clean();
    }
}