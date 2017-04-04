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
            Redirect::to('/vastuuhenkilo/kurssit', array('message' => 'Kurssia muokattiin onnistuneesti'));
        } else {
            $kayttaja = Vastuuhenkilo::getTestiVH();

            $kurssi = Kurssi::etsi($id);
            View::make('vastuuhenkilö/kurssi_muokkaa.html', array(
                'kayttaja' => $kayttaja,
                'kurssi' => $kurssi, 
                'errors' => $errors
            ));
        }
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
