<?php

class KurssiController extends BaseController{
    
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
