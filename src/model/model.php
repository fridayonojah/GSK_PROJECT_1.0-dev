<?php

/**
 * This is the model class all the model classes i.e the classes that inserts and retrives data 
 * should inherit from this model
 * 
 * This class should be also be written in such away that it will be possible to switch to Medoo or an ORM
 * 
 * Note: Normally this class should be designed in such a way that we will inject the database as a 
 * dependancy but right now there is no time to do that it is all coupled into on protected property and maybe methods
 */



// Using Medoo namespace
use Medoo\Medoo; 

class Model{
    // protected $db;
    private $error = NULL;

    
    protected function set_medoo_db(){
        $db = new Medoo([
            // required
            'database_type' => 'mysql',
            'database_name' => getenv('DB_NAME'),
            'server' => getenv('DB_HOST'),
            'username' => getenv('DB_USER'),
            'password' => getenv('DB_PASS'),
        ]);
        
        return $db;
    }


    protected function set_error(string $error){
        $this->error = $error;
    }

    // This error is recieved from the controller, the controller decides how to 
    // log this error and also deliver it to the users
    public function get_error(){
        return $this->error;
    }
}


require 'userModel.php';
require 'authModel.php';
require 'registerModel.php';