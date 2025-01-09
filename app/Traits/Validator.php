<?php

namespace App\Traits;

trait Validator{
    public function validate(array $data): array
    {
        $required_keys = [];

        foreach($data as $key=>$value){
            if(array_key_exists($key,$_REQUEST) and !empty($_REQUEST[$key])){
                continue;
            }
            $required_keys[$key] = $key . ' is required';
        }
        if(!empty($required_keys)){
            apiResponse(['errors' => $required_keys],400);
        }
        return $_REQUEST;
    }
}