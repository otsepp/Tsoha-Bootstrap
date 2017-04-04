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
        $matti = Vastuuhenkilo::authenticate('Matti', 'ssana');
        
        $_SESSION['kayttaja'] = $matti->id;
        $_SESSION['vastuuhenkilo_status'] = 1;
       
        Kint::dump(BaseController::get_user_logged_in());
        Kint::dump($_SESSION);
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
