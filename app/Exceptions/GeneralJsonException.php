<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class GeneralJsonException extends Exception
{

    protected $code = 422;
    /**
     * @return void
     */
    public function report()
    {

    }


    /**
     * @return void
     */
    public function render($request)
    {
        return new JsonResponse([
            'errors' => [
                'message'=>$this->getMessage()
            ]
        ],$this->code) ;


    }
}
