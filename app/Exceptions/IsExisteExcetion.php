<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Support\Responsable;

class IsExisteExcetion extends Exception implements Responsable
{
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function toResponse($request)
    {
        return response(['success' => $this->data['code'], 'message' => $this->data['name'] . ' is existe'], 200);
    }
}
