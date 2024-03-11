<?php declare(strict_types=1);
require_once $_SERVER['DOCUMENT_ROOT']."/src/core/DataMapper.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/models/Category.php";
class CategoryMapper extends DataMapper
{
    public function create(object $obj) : ?int
    {
        $sql = "INSERT INTO `categories` (`category_name`, `category_description`) 
                VALUES ('{$obj->getCategoryName()}','{$obj->getCategoryDescription()}');";
        $this->database->getPDO()->prepare($sql)->execute();

        $id = $this->database->getPDO()->lastInsertId();
        if (gettype($id) == "string") {
            return intval($id);
        }
        return null;

    }
    public function get(int $id) : ?Category
    {
        $sql = "SELECT * 
                FROM `categories` 
                WHERE `category_id` = '$id';";
       $data = $this->executeAndFetch($sql);
        if ($data)
        {
            return new Category($data["category_id"],$data["category_name"],$data["category_description"]);
        }
        return Null;
    }
    public function update($obj) : bool
    {
        $sql = "UPDATE `categories` 
                SET `category_name`='{$obj->getCategoryName()}',`category_description`='{$obj->getCategoryDescription()}'                          
                WHERE `category_id` = '{$obj->getCategoryId()}';";
        return $this->execute($sql);
    }
    public function delete($obj) : bool
    {
        $sql = "DELETE FROM `categories` WHERE `category_id` = '{$obj->getCategoryId()}';";
        return $this->execute($sql);
    }
    public function getAll() : ?array
    {
        $sql = "SELECT * FROM `categories`;";
        $data = $this->executeAndFetchAll($sql);
        if ($data)
        {
            $categoriesData = array();
            foreach ($data as $category)
            {
                $categoriesData[] = new Category($category["category_id"],$category["category_name"],$category["category_description"]);
            }
            return  $categoriesData;
        }
        return null;
    }
}