<?php
namespace App\Exceptions;


class ResourceNotFoundException extends ClientErrorException
{
    public $status = '404';
    public $title = 'resource(s) not found';
    public $detail = '';
}

?>
