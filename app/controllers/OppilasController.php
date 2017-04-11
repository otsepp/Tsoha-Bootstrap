<?php

class OppilasController extends BaseController {
    
    public static function login() {
        View::make('oppilas/login.html');
    }
    
    public static function handle_login() {
        $params = $_POST;
        $kayttaja = Oppilas::authenticate($params['nimi'], $params['salasana']);
        
        if (!$kayttaja) {
            View::make('oppilas/login.html', array('error' => 'väärä käyttäjätunnus tai salasana'));
        } else {
            self::tyhjenna_sessio();
            $_SESSION['kayttaja'] = $kayttaja->id;
            $_SESSION['oppilas_status'] = 1;
            self::koti();
        }
    }
    
    public static function koti() {
        self::tarkista_onko_kayttaja_oppilas();
        $kayttaja = self::get_user_logged_in();
        
        $kurssit_joista_voi_tehda_kys = Kurssi::kurssitJoistaOppilasVoiTehdaKyselyn($kayttaja->id);
        $kurssit_joille_ei_ilm = Kurssi::kurssitJoillaEiOppilasta($kayttaja->id);
        
        $kayttaja = self::get_user_logged_in();
        View::make('oppilas/koti.html', array(
            'kayttaja' => $kayttaja,
            'kurssit_joista_voi_tehda_kys' => $kurssit_joista_voi_tehda_kys,
            'kurssit_joille_ei_ilm' => $kurssit_joille_ei_ilm
        ));
    }
    
}
