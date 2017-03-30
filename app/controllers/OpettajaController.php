<?php

class OpettajaController extends BaseController {
    
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
