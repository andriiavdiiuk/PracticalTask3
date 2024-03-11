<?php declare(strict_types=1);

class ForbiddenException extends Exception
{
    protected $message = "Access Denied: You do not have permission to perform this action.";
    protected $code = 403;
}