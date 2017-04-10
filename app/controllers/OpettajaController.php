<?php

class OpettajaController extends BaseController {
    
    public static function luoOpettaja() {
        self::tarkista_onko_kayttaja_vastuuhenkilo();
        $params = $_POST;
        $opettaja = new Opettaja(array(
            'laitos_id' => $params['laitos_id'],
            'nimi' => $params['nimi']
        ));
        $errors = $opettaja->errors();
        if(count($errors) == 0) {
           $opettaja->talleta();
            Redirect::to('/vastuuhenkilo/opettajat', array('message' => 'Kurssi lisätty'));
        } else {
            $kayttaja = Vastuuhenkilo::getTestiVH();
            View::make('vastuuhenkilö/uusi_opettaja.html', array(
                'kayttaja' => $kayttaja,
                'errors' => $errors
                ));
        }
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
