<?php declare(strict_types=1);
class NotFoundException extends Exception
{
    protected $message = "Page not found";
    protected $code = 404;
}