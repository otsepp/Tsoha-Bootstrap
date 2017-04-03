<?php

class OpettajaController extends BaseController {
    
    public static function luoOpettaja() {
        $params = $_POST;
        $opettaja = new Opettaja(array(
            'laitos_id' => $params['laitos_id'],
            'nimi' => $params['nimi']
        ));
        $opettaja->talleta();
        Redirect::to('/vastuuhenkilo/opettajat', array('message' => 'Kurssi lisätty'));
    }
    
    public static function näytä($id) {
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
