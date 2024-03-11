<?php declare(strict_types=1);
session_start();
date_default_timezone_set('Europe/Kyiv');
require_once "src/core/Router.php";
require_once "src/controllers/HomeController.php";
require_once "src/core/Application.php";

Application::init(parse_ini_file('db_config.ini'));

Application::getRouter()->addRoute("/",[HomeController::class,"index"]);
Application::getRouter()->addRoute("/login",[UserController::class,"login"]);
Application::getRouter()->addRoute("/register",[UserController::class,"register"]);
Application::getRouter()->addRoute("/logout",[UserController::class,"logout"]);
Application::getRouter()->addRoute("/adverts",[AdvertController::class,"adverts"]);
Application::getRouter()->addRoute("/advert/create",[AdvertController::class,"create"]);
Application::getRouter()->addRoute("/advert/[\d]+",[AdvertController::class,"advert"]);
Application::getRouter()->addRoute("/advert/[\d]+/delete",[AdvertController::class,"delete"]);
Application::getRouter()->addRoute("/advert/[\d]+/edit",[AdvertController::class,"edit"]);
Application::getRouter()->addRoute("/adverts/search",[AdvertController::class,"search"]);
Application::run();
?>