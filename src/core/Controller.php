<?php declare(strict_types=1);
require_once "View.php";
abstract class Controller
{
    protected View $view;
    public function render($template,$view,$data=[]) : void
    {
        $this->view = new View();
        echo $this->view->RenderView($template,$view,$data);
    }
}