<?php

class UserModel extends Model{

    private $db;
    private $user_table;

    public function __construct(){
        $this->db = $this->set_medoo_db();
        $this->user_table = 'customer';
    }

    public function emailExist($email){
        if(! $this->db->has($this->user_table, ['email' => $email])){
            return false;
        }
        return true;
    }

    public function personalIdExist($personalId){
        if(! $this->db->has($this->user_table, ['personalID' => $personalId])){
           return false; 
        }
        return true;
    }

    public function insertUser(array $data): bool{
        $insert_data = $this->db->insert($this->user_table, [
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'personalID' => $data['personal_id'],
        ]);

        //check if user is inserted successfully
        if($insert_data->rowCount() > 0){
            return true;
        }
        
        //return a response if no user is inserted
        $this->set_error('Opps could not insert user data');
        return false;
    }

    public function getAllRegisteredUser(){
        $result = $this->db->select($this->user_table, '*');
        return $result;
    }


    public function userExist(int $userId){
        $userIdExist = $this->db->has($this->user_table, ['OR' => [
            'id' => $userId,
        ]]);

        if(!$userIdExist){
            return false;
        }else{
            return true;
        }
    }

    public function getUser(int $userId){
        $userId = $this->db->get($this->user_table, '*', [
            'id' => $userId,
        ]);
        return $userId;
    }

    // public function getSearch($data){
    //     $userId = $this->db->get($this->user_table, '*', ['personalID' => $data]);
    //     return $userId;
    // }

    public function edit($data){
        $result = $this->db->update($this->user_table, [
            'firstname' => $data->firstname,
            'lastname' => $data->lastname,
            'email' => $data->email,
            'phone' => $data->phone
        ], ['id' => $data->customerId]);

        // check if a user was successful edit

        if(!$result->rowCount() > 0){
            return false;
        }
        return true;
    }

    public function deleteData($data):bool{
        $result = $this->db->delete($this->user_table, ['id' => $data->customerId]);

        if($this->userExist($data->customerId)){
            return false;
        }
        return true;
    }  

    public function getse(int $userId){
        $userId = $this->db->get($this->user_table, '*', [
            'id' => $userId,
        ]);
        return $userId;
    }

    public function getSearch($search){
        $search_info = $this->db->select($this->user_table, '*', 
        [
            'personalID' => $search->search,
        ], 
        [
            'OR' => [
                'firstname' => $search->search
            ]
        ]);
        return  $search_info;
    }   
}