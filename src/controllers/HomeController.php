<?php declare(strict_types=1);
require_once $_SERVER['DOCUMENT_ROOT']."/src/core/Controller.php";
class HomeController extends Controller
{
    public function index() : void
    {
        $this->render("Template","Home",["title"=>"Home"]);
    }
}