<?php


class VastuuhenkiloController extends BaseController {
        
    public static function login() {
        View::make('vastuuhenkilö/login.html');
    }
    
    public static function handle_login() {
        $params = $_POST;
        
        $kayttaja = Vastuuhenkilo::authenticate($params['nimi'], $params['salasana']);
        
        if (!$kayttaja) {
            View::make('vastuuhenkilö/login.html', array('error' => 'väärä käyttäjätunnus tai salasana'));
        } else {
            
            $_SESSION['kayttaja'] = $kayttaja->id;
            $_SESSION['vastuuhenkilo_status'] = 1;
            self::koti();
        }
        
    }
    
    public static function koti() {
        $kayttaja = self::get_user_logged_in();
        View::make('vastuuhenkilö/koti.html', array('kayttaja' => $kayttaja));
    }
    
    public static function kurssit() {
        $kayttaja = self::get_user_logged_in();
        View::make('vastuuhenkilö/kurssit.html', array(
            'kayttaja' => $kayttaja,
            'kurssit' => Kurssi::laitoksenKurssit($kayttaja->laitos_id)
        ));
    }
    
    public static function kurssitYhteenveto() {
        $kayttaja = self::get_user_logged_in();
        $rivit = Kysely::yhteenveto($kayttaja->laitos_id);
        View::make('vastuuhenkilö/yhteenveto.html', array(
           'kayttaja' =>  $kayttaja,
           'rivit' => $rivit
        ));
    }
    
    public static function uusiKurssi() {
        $kayttaja = self::get_user_logged_in();
        $opettajat = Opettaja::laitoksenOpettajat($kayttaja->laitos_id);
        View::make('vastuuhenkilö/uusi_kurssi.html', array(
            'kayttaja' => $kayttaja,
            'opettajat' => $opettajat
        ));
    }
    
    public static function muokkaaKurssia($id) {
        $kayttaja = self::get_user_logged_in();
        $kurssi = Kurssi::etsi($id);
        $opettajat = Opettaja::laitoksenOpettajat($kayttaja->laitos_id);
        View::make('vastuuhenkilö/kurssi_muokkaa.html', array(
            'kayttaja' => $kayttaja,
            'kurssi' => $kurssi,
            'opettajat' =>$opettajat
        ));
    }
    
    public static function opettajat() {
        $kayttaja = self::get_user_logged_in();
        $opettajat = Opettaja::laitoksenOpettajat($kayttaja->laitos_id);
        View::make('vastuuhenkilö/opettajat.html', array(
            'kayttaja' => $kayttaja,
            'opettajat' => $opettajat
        ));
    }
    
    public static function kysymykset() {
        $kayttaja = self::get_user_logged_in();
        $yleisetKysymykset = Kysymys::etsiYleisetKysymykset();
        $laitosKysymykset = Kysymys::etsiLaitosKysymykset($kayttaja->laitos_id);
        View::make('vastuuhenkilö/kysymykset.html', array(
            'kayttaja' => $kayttaja,
            'yleisetKysymykset' => $yleisetKysymykset,
            'laitosKysymykset' => $laitosKysymykset
        ));   
    }
    
    public static function uusiKysymys() {
        $kayttaja = self::get_user_logged_in();
        View::make('vastuuhenkilö/uusi_kysymys.html', array(
            'kayttaja' => $kayttaja
        ));
    }
}
