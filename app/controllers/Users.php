<?php
 class Users extends Controller{
     public function __construct(){
        $this->UserModel=$this->model('User');
     }


     //Login method
     public function login(){
       if($_SERVER['REQUEST_METHOD']=='POST'){
            //Process form
            //Sanitize POST data
            $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            //Init data
            $data=[
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'email_error'=>'',
                'password_error'=>'',
            ];

              //Validate data
            if(empty($data['email'])){
                $data['email_error']="Please enter email";
            }

            if(empty($data['password'])){
                $data['password_error']="Please enter password";
            }

            //Check user/email
            if($this->UserModel->findUserByEmail($data['email'])){
                    //User found
            }
            else{
                 $data['email_error']='No user found';
            }

            //Make sure errors are empty
            if(empty($data['email_error'])  && empty($data['password_error'])){
                //Validates
                $loggedInUser=$this->UserModel->login($data['email'],$data['password']);
                if($loggedInUser){
                    //Create Session
                    $this->createUserSession($loggedInUser);
                }
                else{
                    $data['password_error']="Password incorrect";
                    $this->view('users/login',$data);
                }
            }
            else{
                $this->view('users/login',$data);
            }
            //Load view with errors
       }
       //Init data
       else{
        $data=[
            'email'=>'',
            'password'=>'',
            'email_error'=>'',
            'password_error'=>'',
        ];
            //Load the view
            $this->view('users/login',$data);
       }

     }

     //Register method
     public function register(){

        //Check for post
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //Process form'
            // die("Submitted");
            //Sanitize POST data
            $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            //Init data
            $data=[
                'name'=>trim($_POST['name']),
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'confirm_password'=>trim($_POST['confirm_password']),
                'name_error'=>'',
                'email_error'=>'',
                'password_error'=>'',
                'confirm_password_error'=>''
            ];

            //Validate data
            if(empty($data['email'])){
                $data['email_error']="Please enter email";
            }
            else{
                //Check email
                if($this->UserModel->findUserByEmail($data['email'])){
                    $data['email_error']="Email is already taken";
                }


            }
            if(empty($data['name'])){
                $data['name_error']="Please enter name";
            }
            if(empty($data['password'])){
                $data['password_error']="Please enter password";
            }
            else if(strlen($data['password']<6)){
                $data['password_error']='Password must be at least 6 characteres';
            }

            if(empty($data['confirm_password'])){
                $data['confirm_password_error']="Please confirm password";
            }
            else{
                if($data['password']!=$data['confirm_password'])
                {
                    $data['confirm_password_error']="Passwords dont match";
                }
            }

            //Make sure errors are empty
            if(empty($data['email_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])){
                //Validates
                //Hash password
                //One way hash algorithme
                $data['password']=password_hash($data['password'],PASSWORD_DEFAULT);

                //Register user
               if($this->UserModel->register($data))
               {
                   flash('register_success','You are registered and you can login');
                    redirect("users/login ");
               }
               else
               {
                    die("Something went wrong");
               }
            }
            else{
                $this->view('users/register',$data);
            }
            //Load view with errors

        }
        else{
            //Init data
            $data=[
                'name'=>'',
                'email'=>'',
                'password'=>'',
                'confirm_password'=>'',
                'name_error'=>'',
                'email_error'=>'',
                'password_error'=>'',
                'confirm_password_error'=>''
            ];
                //Load the view
                $this->view('users/register',$data);

        }
     }

     public function createUserSession($user){
        $_SESSION['user_id']=$user->id;
        $_SESSION['user_email']=$user->email;
        $_SESSION['user_name']=$user->name;
        redirect('pages/posts');
     }

     public function logout(){
         unset($_SESSION['user_id']);
         unset($_SESSION['user_email']);
         unset($_SESSION['user_name']);
         session_destroy();
         redirect('users/login');
     }


 }
