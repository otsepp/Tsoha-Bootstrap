<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    
    public function validate_nimi($nimi) {
        return $this->validate_string('nimi', $nimi, 20);
    }
    
    public function validate_string($kentta_nimi, $string, $pituus) {
        $errors = array();
        if ($string == '' || $string == null)  {
            $errors[] = $kentta_nimi . ' ei saa olla tyhjä';
        }
        if (strlen($string) > $pituus) {
            $errors[] = $kentta_nimi . ' on liian pitkä (max. ' . $pituus . ')';
        }
        return $errors;
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
