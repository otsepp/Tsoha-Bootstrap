<?php

class KurssiController extends BaseController{
    
    public static function näytä($id) {
        $kurssi = Kurssi::etsi($id);
        
        $käyttäjä = Vastuuhenkilö::getTestiVH(); //testaus
        $vastuuhenkilöStatus = true;
        
        $opettajaStatus = false;
        
        $opettaja = $kurssi->haeOpettaja();
        $osallistujienMäärä = $kurssi->osallistujenMäärä();
        
        View::make('kurssi.html', array(
            'käyttäjä' => $käyttäjä,
            'kurssi' => $kurssi,
            'vastuuhenkilöStatus' => $vastuuhenkilöStatus,
            'opettajaStatus' => $opettajaStatus,
            'opettaja' => $opettaja,
            'osallistujienMäärä' => $osallistujienMäärä
            ));
    }
    
}
