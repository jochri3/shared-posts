<?php

/*
 * App Core
 * Creates URL & loads core controller
 * URL FORMAT -/contoller/method/params
 */

class Core{

  //currentCOntroller et currentMethod vont changer en fonction de notre URL
  protected $currentController='Pages';
  protected $currentMethod='index';
  protected $params=[];

  public function __construct(){
    $url=$this->getUrl();

    //Look in controllers for firts value
    if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
        //if exists,the set as current controller
        $this->currentController=ucwords($url[0]);
        //Unset the 0 index;
        unset($url[0]);
    }

    //Require the controller
    require_once '../app/controllers/'.$this->currentController.'.php';
    
    //Instanciate controller class
    $this->currentController=new $this->currentController; 
    
    //Check for 2nd part of url(method)
    if(isset($url[1])){
      //check to see if method exists in controller
      if(method_exists($this->currentController,$url[1])){
        $this->currentMethod=$url[1];
        unset($url[1]);
      }
    }

    //Get params
    $this->params=$url?array_values($url):[];

    //Call a callback with array pf params
    call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
  }

  public function getUrl(){
    if(isset($_GET['url'])){

      //rtrim enleve toutes les / a droit de la chaine des caracteres
      //format renvoye est : xx/yy/zz et non /xx/yy/zz/
      $url=rtrim($_GET['url'],'/');

      //Bien ecrire l'URL
      $url=filter_var($url,FILTER_SANITIZE_URL);

      //Eclater notre URL en tableau
      $url=explode('/',$url);

      //La valeur retrounee est un tableau
      return $url;
    }
  }
}
