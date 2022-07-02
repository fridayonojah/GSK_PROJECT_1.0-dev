<?php

class Controller {

    private $errorMsg = "";


    /**
     * This model helps to figure out if the request being received is a json,
     * and get the content of that content
     */

    protected function getJSONRequest(){
        $request_data = file_get_contents("php://input");
        $decoded_request = json_decode($request_data);
        return $decoded_request;
    }

    /**
     * This figure out if this is a normal post request
    */

    protected function getPostRequest(): object{
        if(!isset($_POST)){
            throw new Exception("Post data can't be empty");
        }

        // encode the request
        $encode = json_encode($_POST);
        $decode = json_decode($encode);

        // return the decode request
        return $decode;
    }


    /**
     * This model will iterate through request object to check if the
     * required properties are present and return a bool
     * @param stdClass $req_obj: this is the request object
     * @param array $req_property : this is the require data
     * @return bool
     */
    protected function isRequestObjectComplete(stdClass $req_obj, array $req_property){

        // loop through the properties giving
        foreach ($req_property as $value) {
            if(property_exists($req_obj, $value) === false){
                $this->setErrorMsg("Invalid value for $value");
                return false;
            }
            return true;
        } 
        
    }

    private function setErrorMsg(string $msg){
        $this->errorMsg = $msg;
    }

    protected function getErrorMsg(){
        return $this->errorMsg;
    }
}

     