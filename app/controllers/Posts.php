<?php

class Posts extends Controller{

    //L'objectif de ce constructeur esr de chaque fois rediriger les utilisateur vers la page de connexion s'il veulent acceder au posts sans etre authentifies
    public function __construct()
    {
        //On conditione la page des pages par l'authentification
        if(!isLoggedIn()){
            redirect('users/login');
        }
        $this->postModel=$this->model('Post');
        $this->userModel=$this->model('User');
    }

    public function index(){
        //Get posts
        $posts=$this->postModel->getPosts();
        $data=[
            'posts'=>$posts,
        ];
        $this->view('posts/index',$data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //sanitize the posts
            $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $data=[
                'user_id'=>$_SESSION['user_id'],
                'title'=>trim($_POST['title']),
                'body'=>trim($_POST['body']),
                'title_error'=>'',
                'body_error'=>''
            ];
            //Title validation
            if(empty($data['title'])){
                $data['title_error']="Please enter the title";
            }
            if(empty($data['body'])){
                $data['body_error']="Please enter the body text";
            }

            //Make sure there is no errors
            if(empty($data['title_error']) && empty($data['body_error'])){
                //Validates
                if($this->postModel->addPost($data)){
                    flash('post-message','Post Added');
                    redirect('posts');
                }else{
                    die("Something went wrong");
                }
            }
            else{
                //Load the view with errors
                $this->view('posts/add',$data);
            }

        }
        else{
            $data=[
                'title'=>'',
                'body'=>'',
                'title_error'=>'',
                'body_error'=>''
            ];
        }

        $this->view('posts/add',$data);
    }

    //
    public function show($id){
        $post=$this->postModel->getPostById($id);
        $user=$this->userModel->getUserById($post->user_id);
        $data=[
            'post'=>$post,
            'user'=>$user
        ];
        $this->view('posts/show',$data);
    }

    //Edit post
    public function edit($id){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //sanitize the posts
            $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $data=[
                'user_id'=>$_SESSION['user_id'],
                'id'=>$id,
                'title'=>trim($_POST['title']),
                'body'=>trim($_POST['body']),
                'title_error'=>'',
                'body_error'=>''
            ];
            //Title validation
            if(empty($data['title'])){
                $data['title_error']="Please enter the title";
            }
            if(empty($data['body'])){
                $data['body_error']="Please enter the body text";
            }

            //Make sure there is no errors
            if(empty($data['title_error']) && empty($data['body_error'])){
                //Validates
                if($this->postModel->updatePost($data)){
                    flash('post-message','Post updated');
                    redirect('posts');
                }else{
                    die("Something went wrong");
                }
            }
            else{
                //Load the view with errors
                $this->view('posts/edit',$data);
            }

        }
        else{
            //Get existing post from model
            $post=$this->postModel->getPostById($id);
            //Check for Owner
            if($post->user_id!=$_SESSION['user_id']){
                redirect('posts');
            }
            $data=[
                'id'=>$id,
                'title'=>$post->title,
                'body'=>$post->body,
                'title_error'=>'',
                'body_error'=>''
            ];
            $this->view('posts/edit',$data);
        }


    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //Get existing post from model
            $post=$this->postModel->getPostById($id);
            //Check for Owner
            if($post->user_id!=$_SESSION['user_id']){
                redirect('posts');
            }
            if($this->postModel->deletePost($id)){
                flash("post-message","Post removed");
                redirect('posts');
            }
            else{
                die("Something went wrong");
            }
        }
        else{
            redirect('posts');
        }
    }
}