<?php

class staticVastuuHenkiloController {
    
    public static function kotiVastuuhenkilo() {
        View::make('suunnitelmat/vastuuhenkilo/koti_vastuuhenkilo.html');
    }
    
    public static function vastuuhenkiloKurssit() {
        View::make('suunnitelmat/vastuuhenkilo/kurssit.html');
    }
    
    public static function vastuuhenkiloYhteenveto() {
        View::make('suunnitelmat/vastuuhenkilo/yhteenveto.html');
    }
    
    public static function vastuuhenkiloTikape() {
        View::make('suunnitelmat/vastuuhenkilo/tikape.html');
    }
    
    public static function vastuuhenkiloOpettajat() {
        View::make('suunnitelmat/vastuuhenkilo/opettajat.html');
    }
    
    public static function vastuuhenkiloKysymykset() {
        View::make('suunnitelmat/vastuuhenkilo/kysymykset.html');
    }
    
}
