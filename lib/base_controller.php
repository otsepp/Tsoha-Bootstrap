<?php

  class BaseController{

    public static function get_user_logged_in(){
      // Toteuta kirjautuneen käyttäjän haku tähän
        $kayttaja = null;
        
        if (isset($_SESSION['kayttaja'])) {
            $kayttaja_id = $_SESSION['kayttaja'];
            
            if (isset($_SESSION['vastuuhenkilo_status'])) {
                $kayttaja = Vastuuhenkilo::etsi($kayttaja_id);
            } elseif(isset($_SESSION['opettaja_status'])) {
                $kayttaja = Opettaja::etsi($kayttaja_id);
            } elseif(isset($_SESSION['oppilas_status'])) {
                $kayttaja = Oppilas::etsi($kayttaja_id);
            }
        }
      return $kayttaja;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
    }

  }
