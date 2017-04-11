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
    
    public static function tarkista_onko_kayttaja_vastuuhenkilo() {
        if (!self::kayttaja_on_vastuuhenkilo()) {
            self::redirect_kun_ei_oikeuksia();
        }
    }
    
    public static function tarkista_onko_kayttaja_opettaja() {
        if (!self::kayttaja_on_opettaja()) {
            self::redirect_kun_ei_oikeuksia();
        }
    }
    
    public static function tarkista_onko_kayttaja_oppilas() {
        if (!self::kayttaja_on_oppilas()) {
            self::redirect_kun_ei_oikeuksia();
        }
    }
    
    public static function redirect_kun_ei_oikeuksia() {
        Redirect::to('/aloitus', array('message' => 'Sinulla ei ole oikeuksia sivulle jota yritit käyttää'));
    }
    public static function kayttaja_on_vastuuhenkilo() {
        if (isset($_SESSION['vastuuhenkilo_status'])) {
            return true;
        }
        return false;
    }
    public static function kayttaja_on_opettaja() {
        if (isset($_SESSION['opettaja_status'])) {
            return true;
        }
        return false;
    }
    public static function kayttaja_on_oppilas() {
         if (isset($_SESSION['oppilas_status'])) {
            return true;
        }
        return false;
    }
    
    public static function tyhjenna_sessio() {
        $_SESSION['kayttaja'] = null;
        $_SESSION['vastuuhenkilo_status'] = null;
        $_SESSION['opettaja_status'] = null;
        $_SESSION['oppilas_status'] = null;
    }
    
    public static function logout() {
       self::tyhjenna_sessio();
       Redirect::to('/aloitus');
    }
    
  }
