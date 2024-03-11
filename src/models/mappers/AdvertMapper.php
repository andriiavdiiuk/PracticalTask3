<?php declare(strict_types=1);
require_once $_SERVER['DOCUMENT_ROOT']."/src/core/DataMapper.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/Models/Advert.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/Models/Category.php";
class AdvertMapper extends DataMapper
{
    public function create(object $obj): ?int
    {
        $date = $obj->getPublicationDate()->format("Y:m:d H:i:s");
        $status = (int)$obj->getStatus();
        $sql = "INSERT INTO `adverts` (`user_id`, `title`,`description`,`status`,`price`,`publication_date`) 
                VALUES ('{$obj->getUser()->getUserId()}','{$obj->getTitle()}','{$obj->getDescription()}',
                        '$status','{$obj->getPrice()}','$date');";
        $this->execute($sql);
        $id = $this->database->getPDO()->lastInsertId();
        if (gettype($id) == "string") {
            return intval($id);
        }
        return null;

    }

    public function get(int $id): ?Advert
    {
        $sql = "SELECT * 
                FROM `adverts` 
                INNER JOIN `users` ON `users`.`user_id` = `adverts`.`user_id`
                WHERE `advert_id` = '$id';";
        $data = $this->executeAndFetch($sql);
        if ($data) {
            $categories = $this->getCategories($id);
            return new Advert($data["advert_id"], new User($data["user_id"], $data["firstname"], $data["lastname"]),
                $data["title"], $data["description"], (bool)$data["status"],
                $data["price"], new DateTime($data["publication_date"]), $categories);
        }
        return Null;
    }

    public function update($obj): bool
    {

        $date = $obj->getPublicationDate()->format("Y:m:d H:i:s");
        $status = (int)$obj->getStatus();
        $sql = "UPDATE `adverts` 
                SET `user_id`='{$obj->getUser()->getUserId()}', `title`='{$obj->getTitle()}',
                    `description`='{$obj->getDescription()}',`price`='{$obj->getPrice()}', `status`='$status', `publication_date`='$date'                             
                WHERE `advert_id` = '{$obj->getAdvertId()}';";
        $result = $this->execute($sql);
        return $result && $this->updateAdvertCategories($obj->getAdvertId(), $obj->getCategories());
    }

    public function delete($obj): bool
    {
        $sql = "DELETE FROM `advertCategories`
                WHERE `advert_id` = '{$obj->getAdvertId()}';";
        return $this->execute($sql);
    }

    public function linkAdvertToCategory(int $advert_id, int $category_id): bool
    {
        $sql = "INSERT IGNORE INTO `advertCategories` (`advert_id`,`category_id`) 
                VALUES ('$advert_id','$category_id');";
        return $this->execute($sql);
    }
    public function updateAdvertCategories(int $advert_id, array $category_ids): bool
    {
        $sql = "DELETE FROM `advertCategories`
                WHERE `advert_id` = '$advert_id';";
        $result = $this->execute($sql);
        if ($result) {
            foreach ($category_ids as $category_id) {
                $this->linkAdvertToCategory($advert_id, (int)$category_id);
            }
        }
        return $result;
    }

    public function getAll(): ?array
    {
        $sql = "SELECT * FROM `adverts`;";
        $data = $this->executeAndFetchAll($sql);
        return $this->getArrayOfAdvertsFromData($data);
    }

    public function getCategories(int $advert_id) : array
    {
        $sql = "SELECT `categories`.*
               FROM `categories` 
               INNER JOIN `advertCategories` ON `advertCategories`.`category_id`  =`categories`.`category_id` 
               WHERE `advertCategories`.`advert_id` = '$advert_id';";
        $result = $this->executeAndFetchAll($sql);
        $categories = array();
        foreach ($result as $category) {
            $categories[] = new Category($category["category_id"], $category["category_name"], $category["category_description"]);
        }
        return $categories;
    }

    public function searchByTitle(string $value): ?array
    {
        $sql = "SELECT *
                FROM `adverts`
                WHERE `title` LIKE '$value%';";
        $data = $this->executeAndFetchAll($sql);
        return $this->getArrayOfAdvertsFromData($data);
    }

    public function searchByCategories(array $categories): ?array
    {
        $categoriesString = implode("','", $categories);
        $sql = "SELECT `adverts`.*
                FROM `adverts`
                JOIN `advertCategories` ON `adverts`.`advert_id` = `advertCategories`.`advert_id`
                JOIN `categories` ON  `advertCategories`.`category_id` = `categories`.`category_id`
                WHERE `categories`.`category_name` IN ('$categoriesString'); ";
        $data = $this->executeAndFetchAll($sql);
        return $this->getArrayOfAdvertsFromData($data);
    }

    public function searchByTitleAndCategories(string $title,array $categories) : ?array
    {
        $categoriesString = implode("','", $categories);
        $sql = "SELECT DISTINCT `adverts`.*
                FROM `adverts`
                JOIN `advertCategories` ON `adverts`.`advert_id` = `advertCategories`.`advert_id`
                JOIN `categories` ON  `advertCategories`.`category_id` = `categories`.`category_id`
                WHERE `categories`.`category_name` IN ('$categoriesString')
                AND `adverts`.`title` LIKE '$title%';";
        $data = $this->executeAndFetchAll($sql);
        return $this->getArrayOfAdvertsFromData($data);
    }


    private function getArrayOfAdvertsFromData($data): ?array
    {
        if ($data) {
            $adverts = array();
            foreach ($data as $advert) {
                $categories = $this->getCategories($advert["advert_id"]);
                $adverts[] = new Advert($advert["advert_id"], null,
                    $advert["title"], $advert["description"], (bool)$advert["status"],
                    $advert["price"], new DateTime($advert["publication_date"]), $categories);
            }
            return $adverts;

        }
        return null;
    }
}