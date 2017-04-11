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
    }
  }
