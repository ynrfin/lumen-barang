<?php

namespace App\Exceptions;

use Exception;

class ServerException extends Exception implements CustomException
{
    public $title;
    public $description;

    public function render()
    {
        return response()->json([
            'status' => '500',
            'title' => $this->title,
            'description' => $this->description
        ]);
    }
}

?>
