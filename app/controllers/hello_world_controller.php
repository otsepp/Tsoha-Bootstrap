<?php

class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('home.html');
    }

    public static function sandbox(){
        $yleiset = Kysymys::etsiYleisetKysymykset();
        $kurssiK = Kysymys::etsiKurssiKysymykset(1);
        $laitosK = Kysymys::etsiLaitosKysymykset(1);
        Kint::dump($yleiset);
        Kint::dump($kurssiK);
        Kint::dump($laitosK);
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
