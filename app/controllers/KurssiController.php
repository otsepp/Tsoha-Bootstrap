<?php

class KurssiController extends BaseController{
    
    public static function luoKurssi() {
        $params = $_POST;
            
        $kurssi = new Kurssi(array(
            'laitos_id' => $params['laitos_id'],
            'opettaja_id' => $params['opettaja_id'],
            'nimi' => $params['nimi']
        ));
        $kurssi->talleta();
        Redirect::to('/vastuuhenkilo/kurssit', array('message' => 'Kurssi lisätty'));
    }
    
    public static function näytä($id) {
        $kurssi = Kurssi::etsi($id);
        
        $kayttaja = Vastuuhenkilo::getTestiVH(); //testaus
        $vastuuhenkiloStatus = true;
        
        $opettajaStatus = false;
        
        $opettaja = $kurssi->haeOpettaja();
        $osallistujienMaara = $kurssi->osallistujenMaara();
        
        View::make('kurssi.html', array(
            'kayttaja' => $kayttaja,
            'kurssi' => $kurssi,
            'vastuuhenkiloStatus' => $vastuuhenkiloStatus,
            'opettajaStatus' => $opettajaStatus,
            'opettaja' => $opettaja,
            'osallistujienMaara' => $osallistujienMaara
            ));
    }
    
}
