<?php

class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
      View::make('home.html');
    }
    
    public static function kirjautuminen() {
        View::make('kirjautuminen.html');
    }

    public static function sandbox(){
        //Kint::dump($varname);
        $opettaja = new Opettaja(array(
            'id' => 1,
            'laitos_id' => 0,
            'nimi' => 'Kaarle kustaa xvi vaasa'
        ));
        $kurssi = new Kurssi(array(
           'nimi' => 'Apart from counting words and characters, oasdasagaga' 
        ));
        $kysymys = new Kysymys(array(
           'sisalto' => '' 
        ));
        Kint::dump($opettaja->errors());
        Kint::dump($kurssi->errors());
        Kint::dump($kysymys->errors());
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
