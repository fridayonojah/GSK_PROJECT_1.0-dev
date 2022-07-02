<?php
/**
 * This is the controller that handles all the logic concerning:
 *  Authorization of the application by the root user.
 */


class AuthUser{
    protected $auth_userModel;

    public function __construct(){
        $this->auth_userModel = new AuthModel();
    }

    /**
     * This methods deals with creating different level of users e.g admin, editor
     */
    public function createUser(){
        if(!Auth::isRootAdmin()){
            Auth::logout();
        }
        echo $GLOBALS['twig']->render('gsk_create_user.html');
    }

    public function create_user(){
        if(!Auth::isRootAdmin()){
            Auth::logout();
        }

        $data = $_POST;
        $req_data = ['fullname', 'username', 'password', 'email', 'role', 'profile_pix'];

        $user_data = app_is_data_complete($data, $req_data);
        if($user_data !== false){
            $user_data = app_clean_user_data($user_data);
        }else{
            app_error("Registration Failed. Please try again later.");
        }

        //check if email, and username
        $email_exist = $this->auth_userModel->user_exists($user_data['email']);
        $username_exist = $this->auth_userModel->user_exists($user_data['username']);
   
        if($email_exist || $username_exist){
            app_error("The email or username provided already exist");
        }

        // Hash password given by users
        $user_data['password'] = password_hash($user_data['password'], PASSWORD_DEFAULT);
        $req_data = $this->auth_userModel->insertUsers($user_data);
        app_success("Successfully register " . $user_data['fullname'] . " as " . $user_data['role']);
    }

    public function allUser(){
        if(!Auth::isRootAdmin()){
            Auth::logout();
        }
        
        $users = $this->auth_userModel->getAllUsers();
        echo $GLOBALS['twig']->render('gsk_all_user.html', ['users' => $users]);
    }
}