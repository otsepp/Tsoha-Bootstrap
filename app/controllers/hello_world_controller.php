<?php

class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('home.html');
    }
    
    public static function aloitus() {
        View::make('aloitus.html');
    }

    public static function sandbox(){
        //Kint::dump($varname);
        Kint::dump($_SESSION);
        Kint::dump(BaseController::get_user_logged_in());
        Kint::dump(BaseController::kayttaja_on_opettaja());
    }
  }
