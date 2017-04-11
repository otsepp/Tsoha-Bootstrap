<?php

class KurssiController extends BaseController{
    
    public static function luoKurssi() {
        $params = $_POST;
        $kurssi = new Kurssi(array(
            'laitos_id' => $params['laitos_id'],
            'opettaja_id' => $params['opettaja_id'],
            'nimi' => $params['nimi']
        ));
        $errors = $kurssi->errors();
        if (count($errors) == 0) {
            $kurssi->talleta();
            Redirect::to('/vastuuhenkilo/kurssit', array('message' => 'Kurssi lisätty'));
        } else {
             $kayttaja = Vastuuhenkilo::getTestiVH();
             $opettajat = Opettaja::laitoksenOpettajat($kayttaja->laitos_id);
             View::make('vastuuhenkilö/uusi_kurssi.html', array(
                'kayttaja' => $kayttaja,
                'opettajat' => $opettajat,
                'errors' => $errors
            ));
        }
    }
    
    public static function paivita($id) {
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'laitos_id' => $params['laitos_id'],
            'opettaja_id' => $params['opettaja_id'],
            'nimi' => $params['nimi'],
            'kysely_kaynnissa' => $params['kysely_kaynnissa']
        );
        $kurssi = new Kurssi($attributes);
        $errors = $kurssi->errors();
        if (count($errors) == 0) {
            $kurssi->paivita();
            
            if (self::kayttaja_on_vastuuhenkilo()) {
                Redirect::to('/vastuuhenkilo/kurssit', array('message' => 'Kurssia muokattiin onnistuneesti'));
            } else if (self::kayttaja_on_opettaja()) {
                Redirect::to('/kurssi/'.$id);
            }
            
        } else {
            $kayttaja = self::get_user_logged_in();
            $opettajat = Opettaja::laitoksenOpettajat($kayttaja->laitos_id);
            $kurssi = Kurssi::etsi($id);
            View::make('vastuuhenkilö/kurssi_muokkaa.html', array(
                'kayttaja' => $kayttaja,
                'kurssi' => $kurssi,
                'opettajat' => $opettajat,
                'errors' => $errors
                    ));
        }
    }
    
    public static function näytä($id) {
        $kurssi = Kurssi::etsi($id);
        $kayttaja = self::get_user_logged_in();
        
        $vastuuhenkiloStatus = self::kayttaja_on_vastuuhenkilo();
        $opettajaStatus = self::kayttaja_on_opettaja();
        if (!$vastuuhenkiloStatus && !$opettajaStatus) {
            self::redirect_kun_ei_oikeuksia();
        }
        $opettaja = $kurssi->haeOpettaja();
        $osallistujienMaara = $kurssi->osallistujenMaara();
        
        $koti_path = null;
        if ($vastuuhenkiloStatus) {
            $koti_path = 'vastuuhenkilo/koti';
        } else if ($opettajaStatus) {
            $koti_path = 'opettaja/koti';
        }
        
        View::make('kurssi.html', array(
            'kayttaja' => $kayttaja,
            'kurssi' => $kurssi,
            'vastuuhenkiloStatus' => $vastuuhenkiloStatus,
            'opettajaStatus' => $opettajaStatus,
            'opettaja' => $opettaja,
            'osallistujienMaara' => $osallistujienMaara,
            'koti_path' => $koti_path
            ));
    }
    
    public static function raportti($id) {
        if(!self::kayttaja_on_vastuuhenkilo() && !self::kayttaja_on_opettaja()) {
            self::redirect_kun_ei_oikeuksia();
        }
        $kayttaja = self::get_user_logged_in();
        $kurssi = Kurssi::etsi($id);
        $tulokset = Kysely::raportti($kurssi->id);
        $kommentit = Kysely::kommentit($kurssi->id);
        
        $vastaajienMaara = Kysely::vastaajienMaara($kurssi->id);
        $vastaajat = $vastaajienMaara . "/" . $kurssi->osallistujenMaara();
        
        $vastuuhenkiloStatus = self::kayttaja_on_vastuuhenkilo();
        $opettajaStatus = self::kayttaja_on_opettaja();
        if (!$vastuuhenkiloStatus && !$opettajaStatus) {
            self::redirect_kun_ei_oikeuksia();
        }
        $koti_path = null;
        if ($vastuuhenkiloStatus) {
            $koti_path = 'vastuuhenkilo/koti';
        } else if ($opettajaStatus) {
            $koti_path = 'opettaja/koti';
        }
        View::make('kurssiraportti.html', array(
           'kayttaja' => $kayttaja,
           'kurssi' => $kurssi,
           'tulokset' => $tulokset,
           'kommentit' => $kommentit,
           'vastaajat' => $vastaajat,
           'vastuuhenkiloStatus' => $vastuuhenkiloStatus,
           'opettajaStatus' => $opettajaStatus,
            'koti_path' => $koti_path
        ));
    }
}
