<?php

class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('home.html');
    }
    
    //Renderöi kurssikyselyn aloitussivun
    public static function aloitus() {
        View::make('aloitus.html');
    }

    public static function sandbox(){
      $ilm = Ilmoittautuminen::kurssin_ilmoittautumiset(1);
      Kint::dump($ilm);
    }
  }
