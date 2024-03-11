<?php declare(strict_types=1);
require_once $_SERVER['DOCUMENT_ROOT']."/src/models/User.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/models/mappers/UserMapper.php";
class UserValidator
{
    public static function validateData(User $obj) : array
    {
        $data = [];
        if ( !(preg_match('/^[a-zA-Z]+$/', $obj->getFirstname())) )
        {
            $data["firstname"] = "first name must contain only letters";
        }
        if ( !(preg_match('/^[a-zA-Z]+$/', $obj->getLastname())) )
        {
            $data["lastname"] = "last name must contain only letters";
        }
        if (! filter_var($obj->getEmail(),FILTER_VALIDATE_EMAIL))
        {
            $data["email"] = "email is invalid";
        }
        return $data;
    }
    public static function validateLogin(User|null $user,string $password) : bool|string
    {
        if ($user === null)
        {
            return "Invalid Email or password";
        }

        if (!hash_equals($user->getPassword(),hash('sha256',$password)))
        {
            return "Invalid Email or password";
        }
        return true;
    }
}
