<?php

class Auth{
    
    private $auth_model;
    

    public function __construct(){
        $this->auth_model = new AuthModel();
    }

    public function login_user(){

        // reguired datas
        $req_login_data = ['email', 'password'];
        $login_data = app_is_data_complete($_POST, $req_login_data);

        $user = $login_data['email'];
        $login_password = $login_data['password'];

        if(! $this->auth_model->user_exists($user)){
            $this->login_error();
            return;
        }

        $user_information = $this->auth_model->get_user($user);

        if(password_verify($login_password, $user_information['password'])){
            $_SESSION['ID'] = $user_information['id'];
            $_SESSION['ROLE'] = $user_information['role'];
            $this->admin_location();
        }else{
            $this->login_error();
            return;
        }
    }

    private function admin_location(){
        $role = $this->userRole();

        switch ($role) {
            case '1':
                app_location('/root');
                break;
            // case '3':
            //     app_location('/club/new-players');
            //     break;
            case '2':
                app_location('/root');
                // header("location: /root");
                break;
        }  
    }

    private function login_error(){
        app_error("Details do not correspond to any thing in our records", 400);
        exit();
    }

    public static function RootAccess():bool{
        if(Auth::isRootAdmin()){
            return true;
        }
        return false;
    }
        
    public static function isRootAdmin(): bool{

        if(!self::isLoggedIn()){
            self::logout();
        }

        if(self::userRole() === 2){
            return true;
        }
        return false;
    }

    public static function userRole(): int{
        return $_SESSION['ROLE'];
    }

    public static function isLoggedIn(): bool {
        if(isset($_SESSION['ROLE'])){
            return true;
        }
        return false;
    }

    public static function logout(){
        session_destroy();
        if(isset($_COOKIE['user'])){
            setcookie('user', '', time() - 360, "/login");
        }
        app_location("/login");
        exit();
    }
    
}