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
        $kurssit = Kurssi::opettajanKurssit($kayttaja->id);
        View::make('opettaja/koti.html', array(
            'kayttaja' => $kayttaja,
            'kurssit' => $kurssit
        ));
    }
    
    //Opettaja ei luo riviä Kysely-tauluun, vaan luo kurssikohtaisia kysmyksiä ja 
    //laittaa kyselyn käyntiin (epäselvä!?)
    public static function luoKysely($id) {
        self::tarkista_onko_kayttaja_opettaja();
        $kayttaja = self::get_user_logged_in();
        $kurssi = Kurssi::etsi($id);
        
        if ($kurssi->kysely_kaynnissa == 1) {
            Redirect::to('/opettaja/koti', array('error' => 'Kysely on jo käynnissä'));
        }
        
        $yleiset_kysymykset = Kysymys::etsiYleisetKysymykset();
        $laitoskysymykset = Kysymys::etsiLaitosKysymykset($kurssi->laitos_id);
        $kurssikysymykset = Kysymys::etsiKurssiKysymykset($kurssi->id);
        
        View::make('opettaja/luo_kysely.html', array(
           'kayttaja' => $kayttaja,
           'kurssi' => $kurssi,
           'yleiset_kysymykset' => $yleiset_kysymykset,
           'laitoskysymykset' => $laitoskysymykset,
           'kurssikysymykset' => $kurssikysymykset
        ));
    }
    
    public static function näytä($id) {
        self::tarkista_onko_kayttaja_vastuuhenkilo();
        $kayttaja = self::get_user_logged_in();
        $opettaja = Opettaja::etsi($id);
        $kurssit = Kurssi::opettajanKurssit($opettaja->id);
        View::make('vastuuhenkilö/opettaja.html', array(
            'kayttaja' => $kayttaja,
            'opettaja' => $opettaja,
            'kurssit' => $kurssit,
        ));
    }
    
}
