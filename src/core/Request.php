<?php declare(strict_types=1);

class Request
{
    private string $URL;
    private array $body;
    public function __construct()
    {
        $this->URL = $_SERVER["REQUEST_URI"];
        $_GET = filter_input_array(INPUT_GET,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->body["get"] = $_GET;
        $this->body["post"] = $_POST;
    }
    public function getPath() : string
    {
        $url = preg_replace('/(\/+)/','/',$this->URL);
        $url = rtrim($url,'/');
        $position= strpos($url,"?");
        if ($position === false)
        {
            return $url;
        }
        return substr($url,0,$position);
    }
    public function getBody() : array
    {
        return $this->body;
    }
}