<?php

require 'app/models/Kurssi.php';
require 'app/models/Opettaja.php';
require 'app/models/Vastuuhenkilö.php';
require 'app/models/Oppilas.php';


class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('home.html');
    }

    public static function sandbox(){
        $laitoksenKurssit = Kurssi::laitoksenKurssit(1);
        $opettajanKurssit = Kurssi::opettajanKurssit(1);
        $opettajat = Opettaja::kaikki();
        Kint::dump($laitoksenKurssit);
        Kint::dump($opettajanKurssit);
        Kint::dump($opettajat);
    }
    
    //static sivu OPPILAS
    public static function etusivu() {
        View::make('suunnitelmat/alku.html');
    }
    public static function kotiOppilas() {
        View::make('suunnitelmat/oppilas/koti_oppilas.html');
    }
    public static function kyselyTikape() {
        View::make('suunnitelmat/oppilas/kysely_tikape.html');
    }
  }
