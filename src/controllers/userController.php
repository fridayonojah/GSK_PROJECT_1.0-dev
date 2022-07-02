<?php

class User extends Controller {

    private $userModel;


    public function __construct(){
        $this->userModel = new UserModel();
    }

    // get all uses
    public function rootDashboard(){
        if(!Auth::isRootAdmin()){
            Auth::logout();
        }
        $allUser = $this->userModel->getAllRegisteredUser();
        echo $GLOBALS['twig']->render('gsk_dashboard.html', ['customer' => $allUser]);
    }

    public function searchUser(){
        if(!Auth::isRootAdmin()){
            Auth::logout();
        }
        
        $data = $this->getPostRequest();
        $req_data = ['search'];

        //check data is complete
        $is_data_complete = $this->isRequestObjectComplete($data, $req_data);

        if(!$is_data_complete){
            app_error($this->getErrorMsg());
            exit();
        }
        
        $serach_info = $this->userModel->getSearch($data);

        if(!$serach_info){
            app_error("Information not found.", 401);
            exit();
        }
        echo $GLOBALS['twig']->render('search.html', ['customer' => $serach_info]);

    }

    
    public function editUserPage($params){
        if(!Auth::isRootAdmin()){
            Auth::logout();
        }

        $user_id = $params['user_id'];

        // check if id exist
        if(! $this->userModel->userExist($user_id)){
            App::_404();
            exit();
        }

        // get the user by it id
        $user = $this->userModel->getUser($user_id);
        echo $GLOBALS['twig']->render("gsk-edit.html", ['customer' => $user]);
    }

    public function userRegisterPage(){
        $personal_id =  "GSK". "-" .rand(89789, 40); 
        echo $GLOBALS['twig']->render('create_user.html', ['personal_id' => $personal_id]);
    }

    // register a user
    public function registerUser(){
        $data = $_POST;
        $req_data = ['firstname','lastname','email','phone','personal_id'];
        
        $check_data_is_complete = app_is_data_complete($data, $req_data);

        if($check_data_is_complete === false){
            app_error("Registration failed all inputs are required.");
        }else{
            $clean_user_datas = app_clean_user_data($check_data_is_complete); 
        }

        // check if email exist 
        $emaiExist = $this->userModel->emailExist($clean_user_datas['email']);
        if($emaiExist){
            app_error("The email is already registered with a user", 401);
        }

        // check if personal id exist
        $personalIdExist = $this->userModel->personalIdExist($clean_user_datas['personal_id']);
        if($personalIdExist){
            app_error("This personal id is already register with a user. Please ignore if you have already registered.", 401);
        }

       //Atempt to submit data to the database
       $submit_datas = $this->userModel->insertUser($clean_user_datas);
        if(!$submit_datas){
            app_error("Registration failed all inputs are required.");
        }
        app_success("Successfully registered " . $clean_user_datas['firstname'] . " copy your personal id " . $clean_user_datas['personal_id'], ".");
    }

    
    public function editUser(){
        if(!Auth::isRootAdmin()){
            Auth::logout();
        }
       
        $data = $this->getPostRequest();
        $req_data = ['firstname','lastname','email','phone'];
        $is_data_complete =$this->isRequestObjectComplete($data, $req_data);

        // check if datas is complete
        if(!$is_data_complete){
            app_error($this->getErrorMsg());
            exit();
        }

        $edit_user = $this->userModel->edit($data);

        if(!$edit_user){
            app_error("Error Updating a user");
            exit();
        }
        app_success("Data Successfully updated");
    }


    public function deleteUser(){
        if(!Auth::isRootAdmin()){
            Auth::logout();
        }
       
        $data = $this->getPostRequest();
        $req_data = ['customerId'];
        $is_data_complete = $this->isRequestObjectComplete($data, $req_data);

        // check if datas is complete
        if(!$is_data_complete){
            app_error($this->getErrorMsg());
            exit();
        }

        $delete_user = $this->userModel->deleteData($data);

        // check if data was deleted
        if($delete_user){  
            app_success("User data successfully deleted");
            exit();
        }
        app_error("Error deleting a user");
    }
  
}