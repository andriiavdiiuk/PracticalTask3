<?php declare(strict_types=1);

require_once $_SERVER['DOCUMENT_ROOT']."/src/models/User.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/core/DataMapper.php";
class UserMapper extends DataMapper
{
    public function create(object $obj) : ?int
    {

        $sql = "INSERT INTO `users` (`firstname`, `lastname`,`email`,`password`) 
                VALUES ('{$obj->getFirstname()}','{$obj->getLastname()}',
                        '{$obj->getEmail()}','{$obj->getPassword()}');";
        $this->execute($sql);

        $id = $this->database->getPDO()->lastInsertId();
        if (gettype($id) == "string") {
            return intval($id);
        }
        return null;

    }
    public function get(int $id) : ?User
    {
        $sql = "SELECT * 
                FROM `users` 
                WHERE `user_id` = '$id';";
        $data = $this->executeAndFetch($sql);
        if ($data)
        {
            return new User($data["user_id"],$data["firstname"],$data["lastname"],$data["email"],$data["password"]);
        }
        return Null;
    }
    public function getByEmail(string $email) : ?User
    {
        $sql = "SELECT * 
                FROM `users` 
                WHERE `email` = '$email';";
        $data = $this->executeAndFetch($sql);
        if ($data)
        {
            return new User($data["user_id"],$data["firstname"],$data["lastname"],$data["email"],$data["password"]);
        }
        return Null;
    }
    public function update($obj) : bool
    {
        $sql = "UPDATE `users` 
                SET `firstname`='{$obj->getFirstname()}', `lastname`='{$obj->getLastname()}',`email`='{$obj->getEmail()}',
                    `password`='{$obj->getPassword()}'                              
                WHERE `author_id` = '{$obj->getAuthorId()}';";
        return $this->execute($sql);
    }
    public function delete($obj) : bool
    {
        $sql = "DELETE FROM `users` WHERE `user_id` = '{$obj->getUserId()}';";
        return $this->execute($sql);
    }
}