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
      $oppilas = Oppilas::etsi(1);
      $kt = Kurssi::kurssitJoillaEiOppilasta($oppilas->id);
      Kint::dump($oppilas);
      Kint::dump($kt);
    }
  }
