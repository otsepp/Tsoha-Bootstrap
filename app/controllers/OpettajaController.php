<?php

class OpettajaController extends BaseController {
    public static function login() {
        View::make('opettaja/login.html');
    }

    public static function handle_login() {
        $params = $_POST;        
        $kayttaja = Opettaja::authenticate($params['nimi'], $params['salasana']);
        
        if (!$kayttaja) {
            View::make('opettaja/login.html', array('error' => 'väärä käyttäjätunnus tai salasana'));
        } else {
            self::tyhjenna_sessio();
            $_SESSION['kayttaja'] = $kayttaja->id;
            $_SESSION['opettaja_status'] = 1;
            self::koti();
        }
    }
    
    public static function koti() {
        self::tarkista_onko_kayttaja_opettaja();
        $kayttaja = self::get_user_logged_in();
        View::make('opettaja/koti.html', array(
            'kayttaja' => $kayttaja
        ));
    }
    
    public static function näytä($id) {
        self::tarkista_onko_kayttaja_vastuuhenkilo();
        $kayttaja = Vastuuhenkilo::getTestiVH();
        $opettaja = Opettaja::etsi($id);
        $kurssit = Kurssi::opettajanKurssit($opettaja->id);
        View::make('vastuuhenkilö/opettaja.html', array(
            'kayttaja' => $kayttaja,
            'opettaja' => $opettaja,
            'kurssit' => $kurssit,
        ));
    }
    
}
