<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function validate_nimi($nimi) {
        if($nimi== '' || $nimi==null) {
            return 'Nimi ei saa olla tyhjä';
        }
        $pituus = 20;
        if(strlen($nimi) > $pituus) {
            return 'Nimi on liian pitkä (max. ' . $pituus . ')';
        }
    }

    public function validate_laitos_id($laitos_id) {
        if ($laitos_id == null) {
            return 'laitos_id ei saa olla tyhjä';
        }
    }
    
    public function validate_kurssi_id($laitos_id) {
        if ($laitos_id == null) {
            return 'laitos_id ei saa olla tyhjä';
        }
    }
    
    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();
//      foreach($this->validators as $validator){
//        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
//      }
      return $this->validators;
//      return $errors;
    }

  }
