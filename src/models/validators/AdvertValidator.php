<?php
require_once $_SERVER['DOCUMENT_ROOT']."/src/models/Advert.php";
class AdvertValidator
{
    public static function validateData(Advert $advert): array
    {
        $errors = array();
        if (!(preg_match('/^[a-zA-Z0-9\s]+$/', $advert->getTitle())))
        {
            $errors["title"] = "Title can only contain letters and numbers ";
        }
        else if (empty(trim($advert->getTitle())))
        {
            $errors["title"] = "Title can't be empty";
        }
        if (empty(trim($advert->getDescription())))
        {
            $errors["description"] = "Description can't be empty";
        }
        if ($advert->getPrice() < 0 )
        {
            $errors["price"] = "Invalid price";
        }
        return $errors;
    }
}