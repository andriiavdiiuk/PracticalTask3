<?php declare(strict_types=1);
require_once $_SERVER['DOCUMENT_ROOT']."/src/core/Controller.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/core/exceptions/ForbiddenException.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/core/exceptions/NotFoundException.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/models/Advert.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/models/mappers/AdvertMapper.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/models/User.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/models/mappers/CategoryMapper.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/models/Category.php";
require_once $_SERVER['DOCUMENT_ROOT']."/src/models/validators/AdvertValidator.php";
class AdvertController extends Controller
{
    public function adverts(Request $request) : void
    {
        $advertMapper = new AdvertMapper();
        $searchTerm = $request->getBody()["get"]["search"] ?? null;
        $categories = $request->getBody()["get"]["categories"] ?? null;

        if ($searchTerm && $categories)
        {
            $adverts = $advertMapper->searchByTitleAndCategories($searchTerm, $categories);
        }
        elseif ($searchTerm)
        {
            $adverts = $advertMapper->searchByTitle($searchTerm);
        }
        elseif ($categories)
        {
            $adverts = $advertMapper->searchByCategories($categories);
        }
        else
        {
            $adverts = $advertMapper->getAll();
        }

        $this->render("Template", "Adverts", ["title" => "All adverts", "adverts" => $adverts]);
    }
    public function create(Request $request) : void
    {
        $errors = [];
        if ( !isset($_SESSION["user"]))
        {
            throw new ForbiddenException();
        }
        if (isset($request->getBody()["post"]))
        {
            $data = $request->getBody()["post"];
            $advertMapper = new AdvertMapper();
            $advert = new Advert(-1,
                new User($_SESSION["user"]["user_id"]), $data["title"],$data["description"],True,
                (int)$data["price"],new DateTime("now"));
            $errors = AdvertValidator::validateData($advert);
            if (count($errors) == 0)
            {
                $advert_id = $advertMapper->create($advert);
                if (isset($data["categories"]))
                {
                    foreach ($data["categories"] as $category_id) {
                        $advertMapper->linkAdvertToCategory((int)$advert_id, (int)$category_id);
                    }
                }
                Application::getRouter()->redirect("/advert/$advert_id");
            }
        }

        $categoryMapper = new CategoryMapper();
        $categories = $categoryMapper->getAll();

        $this->render("Template","AdvertCreate",["title"=>"Create new advert","categories" => $categories,"errors" => $errors]);
    }
    public function advert(Request $request) : void
    {
        $advertMapper = new AdvertMapper();
        $url = explode("/",$request->getPath());
        $id = (int)end($url);
        $advert = $advertMapper->get($id);
        if ($advert)
        {
            $this->render("Template", "AdvertPage", ["title" => "{$advert->getTitle()}", "advert" => $advert]);
        }
        else
        {
            throw new NotFoundException();
        }
    }
    public function delete(Request $request) : void
    {
        if (isset($_SESSION["user"]))
        {
            $advertMapper = new AdvertMapper();
            $url = explode("/",$request->getPath());
            $id = (int)$url[count($url)-2];
            $advert = $advertMapper->get($id);
            if ($_SESSION["user"]["user_id"] == $advert->getUser()->getUserId())
            {
                $advertMapper->delete($advert);
                Application::getRouter()->redirect("/");
            }
        }
        throw new ForbiddenException();
    }
    public function edit(Request $request) : void
    {
        $errors = [];
        $advertMapper = new AdvertMapper();
        $url = explode("/",$request->getPath());
        $id = (int)$url[count($url)-2];
        $advert = $advertMapper->get($id);
        if (isset($_SESSION["user"]) && $_SESSION["user"]["user_id"] == $advert->getUser()->getUserId())
        {
            if (isset($request->getBody()["post"]))
            {
                $data = $request->getBody()["post"];
                $advert->setTitle($data["title"]);
                $advert->setDescription($data["description"]);
                $advert->setPrice((int)$data["price"]);
                if (isset($data["categories"])) {
                    $advert->setCategories($data["categories"]);
                }
                if (isset($data["status"]))
                {
                    $advert->setStatus(true);
                }
                else
                {
                    $advert->setStatus(false);
                }
                $errors = AdvertValidator::validateData($advert);
                if (count($errors) == 0)
                {
                    $advertMapper->update($advert);
                    Application::getRouter()->redirect("/advert/{$advert->getAdvertId()}");
                }
            }
            $categoryMapper = new CategoryMapper();
            $categories = $categoryMapper->getAll();


            $this->render("Template", "AdvertEdit", ["title" => "{$advert->getTitle()}", "advert" => $advert, "categories" => $categories,"errors" => $errors]);

        }
        else
        {
            throw new ForbiddenException();
        }
    }
    public function search() : void
    {
        $categoryMapper = new CategoryMapper();
        $categories = $categoryMapper->getAll();

        $this->render("Template", "AdvertSearch", ["title" => "Search adverts", "categories" => $categories]);
    }
}