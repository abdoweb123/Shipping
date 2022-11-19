<?php

namespace App\Http\Controllers\Traits;

trait CheckApi
{


    public function returnMessageError($message = null, $code = null, $option = null)
    {
        return response()->json([

            'status'=>false,
            'message'=>$message,
            'code'=>$code,
            'option'=>$option,

        ]);
    }


    public function returnMessageSuccess($message,$code)
    {
        return response()->json([

            'status'=>true,
            'message'=>$message,
            'code'=>$code,

        ]);
    }


    public function returnMessageData($message, $code, $key, $value)
    {
        return response()->json([

            'status'=>true,
            'message'=>$message,
            'code'=>$code,
            $key=>$value,

        ]);
    }

}
