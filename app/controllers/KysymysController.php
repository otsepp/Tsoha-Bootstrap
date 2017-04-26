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
    
    public static function muokkausNakyma($id) {
        $kayttaja = self::get_user_logged_in();
        
        $kysymys = Kysymys::etsi($id);
        
        $vastuuhenkiloStatus = self::kayttaja_on_vastuuhenkilo();
        $opettajaStatus = self::kayttaja_on_opettaja();
        if (!$vastuuhenkiloStatus && !$opettajaStatus) {
            self::redirect_kun_ei_oikeuksia();
        }
        if ($opettajaStatus ) {
           if ($kysymys->kurssi_id == null) {
               self::redirect_kun_ei_oikeuksia();
           } else {
               $kurssi_idt = Kurssi::opettajanKurssitIdt($kayttaja->id);
               if (!in_array($kysymys->kurssi_id, $kurssi_idt)) {
                   self::redirect_kun_ei_oikeuksia();
               }
           }
        }
        View::make('kysymys_muokkaa.html', array(
            'kayttaja' => $kayttaja,
            'kysymys' => $kysymys
        )); 
    }
    
    public static function paivita($id) {
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'laitos_id' => $params['laitos_id'],
            'kurssi_id' => $params['kurssi_id'],
            'sisalto' => $params['sisalto']
        );
        $kysymys = new Kysymys($attributes);
        $errors = $kysymys->errors();
        if (count($errors) == 0) {
            $kysymys->paivita();
            
            if (self::kayttaja_on_vastuuhenkilo()) {
                Redirect::to('/vastuuhenkilo/kysymykset', array('message' => 'Kysymystä muokattiin onnistuneesti'));
            } elseif (self::kayttaja_on_opettaja()) {
                $kurssi_id = $kysymys->kurssi_id;
                Redirect::to('/opettaja/luo_kysely/'.$kurssi_id, array('message' => 'Kysymystä muokattiin onnistuneesti'));
            }
        } else {
            Redirect::to('/kysymykset/muokkaa/'.$kysymys->id, array('errors' => $errors));
        }
    }
    
    public static function poista($id) {
        $kysymys = Kysymys::etsi($id);
        $vastaukset = Vastaus::kysymyksen_vastaukset($id);
        foreach($vastaukset as $vastaus) {
            $vastaus->poista($vastaus->kysymys_id);
        }
        $kysymys->poista();
        if (self::kayttaja_on_vastuuhenkilo()) {
            Redirect::to('/vastuuhenkilo/kysymykset', array('message' => 'Kysymys poistettu'));
        } else if (self::kayttaja_on_opettaja()) {
            $kurssi_id = Kurssi::etsi($kysymys->kurssi_id)->id;
            Redirect::to('/opettaja/luo_kysely/'.$kurssi_id, array('message' => 'Kysymys poistettu'));
        }
    }
    
   private static function tarkista_virheet($kysymys) {
       $errors = $kysymys->errors();
        if(count($errors) == 0) {
            $kysymys->talleta();
            if (self::kayttaja_on_vastuuhenkilo()) {
                Redirect::to('/vastuuhenkilo/kysymykset', array('message' => 'Kysymys lisätty'));
            } else {
                Redirect::to('/opettaja/luo_kysely/'.$kysymys->kurssi_id, array('message' => 'Kysymys lisätty'));
            }
        } else {
            $kayttaja = self::get_user_logged_in();
            if (self::kayttaja_on_vastuuhenkilo()) {
                Redirect::to('/vastuuhenkilo/kysymykset/uusi', array('errors' => $errors));
            } else {
                Redirect::to('/opettaja/luo_kysely/'.$kysymys->kurssi_id, array('errors' => $errors));
            }
        }
   }
    
}
