<?php declare(strict_types=1);

use JetBrains\PhpStorm\NoReturn;

require_once $_SERVER['DOCUMENT_ROOT']."/src/core/Controller.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/models/User.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/models/validators/UserValidator.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/models/mappers/UserMapper.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/core/Application.php";
class UserController extends Controller
{
    public function login(Request $request) : void
    {
        if (isset($_SESSION["user"]))
        {
            Application::getRouter()->redirect("/");
        }
        $error = null;
        if (isset($request->getBody()["post"])) {
            $data = $request->getBody()["post"];
            $userMapper = new UserMapper();
            $user = $userMapper->getByEmail($data["email"]);
            $result = UserValidator::validateLogin($user, $data["password"]);

            if ($result === true) {
                $userData = [
                    "user_id" => $user->getUserId(),
                    "firstname" => $user->getFirstname(),
                    "lastname" => $user->getLastname(),
                    "password" => $user->getPassword(),
                    "email" => $user->getEmail(),
                ];
                $_SESSION["user"] = $userData;
                Application::getRouter()->redirect("/");
            }
            $error = $result;

        }
        $this->render("Template","Login",["title"=> "Login","error"=>$error]);
    }
    public function register(Request $request) : void
    {
        if (isset($_SESSION["user"]))
        {
            Application::getRouter()->redirect("/");
        }
        $errors = array();
        if (isset($request->getBody()["post"]))
        {
            $data = $request->getBody()["post"];
            $user = new User(-1,$data["firstname"],$data["lastname"],$data["email"],hash('sha256',$data["password"]));
            $errors = UserValidator::validateData($user);
            if (count($errors) == 0)
            {
                $userMapper = new UserMapper();
                $userMapper->create($user);
                Application::getRouter()->redirect("/");
            }
        }
        $this->render("Template","Register",["title"=> "Register","errors" => $errors]);
    }
    #[NoReturn] public function logout() : void
    {
        if (isset($_SESSION["user"]))
        {
            unset($_SESSION["user"]);
        }
        Application::getRouter()->redirect("/");
    }
}