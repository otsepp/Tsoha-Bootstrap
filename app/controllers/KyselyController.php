<?php

class KyselyController extends BaseController {
    
    public static function luoKysely() {
        $params = $_POST;
        
        $kysely = new Kysely(array(
            'kurssi_id' => $params['kurssi_id'],
            'oppilas_id' => $params['oppilas_id'],
            'kommentti' => $params['kommentti']
        ));
        $errors = $kysely->errors();
        self::check_for_errors($errors, $params['kurssi_id']);
        //$kysely->talleta();
        
        $kysymys_idt = $params['kysymys_id'];
        $arvosanat = $params['arvosana'];
	$vastaukset = array();
        for ($i = 0; $i < count($kysymys_idt); $i++) {
            $vastaus = new Vastaus(array(
                'kysely_id' => $kysely->id,
                'kysymys_id' => $kysymys_idt[$i],
                'arvosana' => $arvosanat[$i]
            ));
            $errors = $vastaus->errors();
            self::check_for_errors($errors, $params['kurssi_id']);
	    $vastaukset[] = $vastaus;
            //$vastaus->talleta();
        } 
	$kysely->talleta();
	foreach ($vastaukset as $vastaus) {
		$vastaus->talleta();
	}
        Redirect::to('/oppilas/koti', array('message' => 'Kysely lähetetty'));
    }
    
    private static function check_for_errors($errors, $id) {
         if (count($errors) != 0) {
             Redirect::to('/oppilas/kysely/'.$id, array('errors' => $errors));
         }
    }
    
    public static function kysely($id) {
        self::tarkista_onko_kayttaja_oppilas();
        $kayttaja = self::get_user_logged_in();
        
        $kurssi = Kurssi::etsi($id);
        
        $yk = Kysymys::etsiYleisetKysymykset();
        $lk = Kysymys::etsiLaitosKysymykset($kurssi->laitos_id);
        $kk = Kysymys::etsiKurssiKysymykset($kurssi->id);
        $kysymykset = array_merge($yk, $lk, $kk);
        
        View::make('oppilas/kysely.html', array(
           'kayttaja' => $kayttaja,
           'kurssi' => $kurssi,
           'kysymykset' => $kysymykset
        ));
    }
    
}
