<?php
 class Pages extends Controller{
     public function __construct(){
     }
     
     public function index(){
         if(isLoggedIn()){
             redirect('posts');
         }
        $data= [
                'title'=>'Shareposts',
                'description'=>'Simple reseau soicial cree a partir de mon framwork MVC '
            ];
        $this->view("pages/index",$data);
     }
     public function about(){
         $this->view("pages/about");
     }

 }