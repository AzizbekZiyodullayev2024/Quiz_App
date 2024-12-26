<?php

namespace App\Traits;

trait Validator{
    public function validate(array $data){
        $required_keys = [];

        foreach($data as $key=>$value){
            if(array_key_exists($key,$_REQUEST)){
                continue;
            }
            $required_keys[$key] = $key . ' is required';
        }
        if(!empty($required_keys)){
            apiResponse(['errors' => $required_keys],400);
        }
        echo "Eser created with success!";
        return $_REQUEST;
    }
}