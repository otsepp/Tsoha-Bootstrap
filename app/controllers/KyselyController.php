<?php

class KyselyController extends BaseController {
    
    public static function luoKysely() {
        $params = $_POST;
        
        $kysely = new Kysely(array(
            'kurssi_id' => $params['kurssi_id'],
            'oppilas_id' => $params['oppilas_id'],
            'kommentti' => $params['kommentti']
        ));
        $kysymys_idt = $params['kysymys_id'];
        $arvosanat = $params['arvosana'];
	$vastaukset = array();
        for ($i = 0; $i < count($kysymys_idt); $i++) {
            $vastaus = new Vastaus(array(
                'kysely_id' => $kysely->id,
                'kysymys_id' => $kysymys_idt[$i],
                'arvosana' => $arvosanat[$i]
            ));
            $errors = array_merge($kysely->errors(), $vastaus->errors());
            self::check_for_errors($errors, $params['kurssi_id']);
	    $vastaukset[] = $vastaus;
        } 
	$kysely->talleta();
	foreach ($vastaukset as $vastaus) {
                $vastaus->kysely_id = $kysely->id;
		$vastaus->talleta();
	}
        Redirect::to('/oppilas/koti', array('message' => 'Kysely lähetetty'));
    }
    
    private static function check_for_errors($errors, $id) {
         if (count($errors) != 0) {
             Redirect::to('/oppilas/kysely/'.$id, array('errors' => $errors));
         }
    }
    
	//renderöi kyselyn
    public static function kysely($id) {
        self::tarkista_onko_kayttaja_oppilas();
        $kayttaja = self::get_user_logged_in();
        
        $kurssi = Kurssi::etsi($id);
        
        $kurssit_joista_voi_tehda_kyselyn = Kurssi::kurssitJoistaOppilasVoiTehdaKyselyn($kayttaja->id);
        if (!in_array($kurssi, $kurssit_joista_voi_tehda_kyselyn)) {
            Redirect::to('/oppilas/koti', array('error' => 'Olet jo tehnyt kurssin kyselyn'));
            
        }
        
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
