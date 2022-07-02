<?php

class AuthModel extends Model{

    private $db;
    private $auth_table;

    public function __construct(){
        $this->auth_table = 'users';
        $this->db = $this->set_medoo_db();
    }

    /**
     * This model deal with checking if usera exist before login user
     * it take email and password as an req data
     */

     public function user_exists($user){
         if(! $this->db->has($this->auth_table, [
             'OR' => [
                 'email' => $user,
                 'username' => $user
             ]
         ])){
             return false;
         }
         return true;
    }

    public function get_user($user): array{
        // get the user id and password
		$user_info = $this->db->get($this->auth_table, [
            'email',
            'fullname',
            'password',
            'role',
			'id'
		], [
			'OR' => [
				'email' => $user,
				'username' => $user
			]
		]);

        return $user_info;
    }

    /**
     * This is the model responsible for creating a user into the database
     * @params array $user_data : this is the array provide by the controller logic
     * @return bool return true  if the insertion was successfuly and false if the 
     * the insertation wasn't successfuly
     */

    public function insertUsers(array $user_data){
         $insert_users = $this->db->insert($this->auth_table, [
            'email' => $user_data['email'],
            'fullname' => $user_data['fullname'],
            'password' => $user_data['password'],
            'username' => $user_data['username'],
            'role'  => $user_data['role'],
            'profile_pix' => $user_data['profile_pix']
        ]);

        // check if user was success
        if($insert_users->rowCount() > 1){
            return true;
        }

        $this->set_error('Could not insert user into database');
        return false;
    }

    public function getAllUsers(){
        $allUsers = $this->db->select($this->auth_table, [
            'email',
            'fullname',
            'username',
            'role',
            'id'
        ]);

        // this will return the gotten users
        return $allUsers;
    }

    public function countTotalUsers(){
        $total_users = $this->db->count($this->auth_table);
        return $total_users;
    }

    public function deleteUser(int $user_id): bool {
        $ary = $this->db->delete($this->auth_table, [
            'id' => $user_id,
        ]);

        // check if user id was removed
        if($qry->rowCount() > 0){
            return true;
        }
        return false;
    }
}