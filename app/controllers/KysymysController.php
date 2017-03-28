<?php

class KysymysController extends BaseController {
    
    public static function luoYleinenKysymys() {
        $params = $_POST;
        
        $kysymys = new Kysymys(array(
            'laitos_id' => null,
            'kurssi_id' => null,
            'sisalto' => $params['sisalto']
        ));
        $kysymys->talleta();
        Redirect::to('/vastuuhenkilo/kysymykset', array('message' => 'Kysymys lisätty'));
    }
    
    //ei valmis
     public static function luoLaitosKysymys() {
        $params = $_POST;
        
        $kysymys = new Kysymys(array(
            'laitos_id' => $params['laitos_id'],
            'kurssi_id' => null,
            'sisalto' => $params['sisalto']
        ));
        Kint::dump($kysymys);
        $kysymys->talleta();
        Redirect::to('/vastuuhenkilo/kysymykset', array('message' => 'Kysymys lisätty'));
    }
    
   
    
}
