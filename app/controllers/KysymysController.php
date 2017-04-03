<?php

class KysymysController extends BaseController {
    
    public static function luoYleinenKysymys() {
        $params = $_POST;
        $kysymys = new Kysymys(array(
            'laitos_id' => null,
            'kurssi_id' => null,
            'sisalto' => $params['sisalto']
        ));
        KysymysController::tarkista_virheet($kysymys);
    }
    
    //ei valmis
     public static function luoLaitosKysymys() {
        $params = $_POST;
        
        $kysymys = new Kysymys(array(
            'laitos_id' => $params['laitos_id'],
            'kurssi_id' => null,
            'sisalto' => $params['sisalto']
        ));
        KysymysController::tarkista_virheet($kysymys);
    }
    
   public static function tarkista_virheet($kysymys) {
       $errors = $kysymys->errors();
        if(count($errors) == 0) {
            $kysymys->talleta();
            Redirect::to('/vastuuhenkilo/kysymykset', array('message' => 'Kysymys lisätty'));
        } else {
            $kayttaja = Vastuuhenkilo::getTestiVH();
            View::make('vastuuhenkilö/uusi_kysymys.html', array(
                'kayttaja' => $kayttaja,
                'errors' => $errors
            ));
        }
   }
    
}
