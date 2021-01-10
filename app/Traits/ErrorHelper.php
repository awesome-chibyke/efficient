<?php
namespace App\Traits;

trait ErrorHelper{

    function convertErrorToString($error){
        if(is_array($error)){
            $error = implode(':', $error);
        }
        return $error;
    }

    function createStringForErrors($errorArray){//create an error string from error arrays
        $newErrorString = '';
        if(count($errorArray) > 0){

            foreach($errorArray as $k => $eachErrorArray){
                if(strpos($k, '.') !== false){
                    foreach($eachErrorArray as $l => $eachError){
                        $newErrorString .= '<p>'.$eachError.'</p>';
                    }
                }
            }

        }
        return $newErrorString;

    }

}