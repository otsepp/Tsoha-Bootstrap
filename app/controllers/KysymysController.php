<?php

class KysymysController extends BaseController {
    
    public static function luoYleinenKysymys() {
        $params = $_POST;
        $kysymys = new Kysymys(array(
            'laitos_id' => null,
            'kurssi_id' => null,
            'sisalto' => $params['sisalto']
        ));
        self::tarkista_virheet($kysymys);
    }
    
     public static function luoLaitosKysymys() {
        $params = $_POST;
        $kysymys = new Kysymys(array(
            'laitos_id' => $params['laitos_id'],
            'kurssi_id' => null,
            'sisalto' => $params['sisalto']
        ));
        self::tarkista_virheet($kysymys);
    }
    
    public static function luoKurssiKysymys() {
        $params = $_POST;
        $kysymys = new Kysymys(array(
            'laitos_id' => null,
            'kurssi_id' => $params['kurssi_id'],
            'sisalto' => $params['sisalto']
        ));
        self::tarkista_virheet($kysymys);
    }
    
    public static function poista($id) {
        $vastaukset = Vastaus::kysymyksen_vastaukset($kysymys->id);
        foreach($vastaukset as $vastaus) {
            $vastaus->poista($vastaus->kysymys_id);
        }
        $kysymys->poista();
        Redirect::to('/vastuuhenkilo/kysymykset', array('message' => 'Kysymys poistettu'));
    }
    
   public static function tarkista_virheet($kysymys) {
       $errors = $kysymys->errors();
        if(count($errors) == 0) {
            $kysymys->talleta();
            if (self::kayttaja_on_vastuuhenkilo()) {
                Redirect::to('/vastuuhenkilo/kysymykset', array('message' => 'Kysymys lisätty'));
            } else {
                Redirect::to('/opettaja/luo_kysely/'.$kysymys->kurssi_id);
            }
        } else {
            $kayttaja = self::get_user_logged_in();
            
            if (self::kayttaja_on_vastuuhenkilo()) {
                View::make('vastuuhenkilö/uusi_kysymys.html', array(
                    'kayttaja' => $kayttaja,
                    'errors' => $errors
                 ));
            } else {
                OpettajaController::luoKysely($kysymys->kurssi_id, $errors);
            }
        }
   }
    
}
