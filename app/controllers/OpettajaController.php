<?php

class OpettajaController extends BaseController {
    
    public static function näytä($id) {
        $käyttäjä = Vastuuhenkilö::getTestiVH();
        
        $opettaja = Opettaja::etsi($id);
        $kurssit = Kurssi::opettajanKurssit($opettaja->id);
        
        View::make('vastuuhenkilö/opettaja.html', array(
            'käyttäjä' => $käyttäjä,
            'opettaja' => $opettaja,
            'kurssit' => $kurssit,
        ));
    }
    
}
