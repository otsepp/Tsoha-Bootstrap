<?php

class IlmoittautuminenController {
    
   public static function luo() {
       $params = $_POST;
       $ilmoittautuminen = new Ilmoittautuminen(array(
          'kurssi_id' => $params['kurssi_id'],
          'oppilas_id' => $params['oppilas_id']
       ));
       $ilmoittautuminen->talleta();
       Redirect::to('/oppilas/koti', array('message' => 'Ilmoittautuminen luotiin'));
   } 
    
}
