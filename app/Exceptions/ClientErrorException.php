<?php

namespace App\Exceptions;

use Exception;

class ClientErrorException extends Exception implements CustomException
{
    public $title;
    public $status;
    public $detail;

    public function render()
    {
        return response()->json([
            'status' => $this->status,
            'title' => $this->title,
            'detail' => $this->detail
        ]);
    }
}

?>
