<?php

class staticVastuuHenkiloController {
    
    public static function kotiVastuuhenkilo() {
        View::make('suunnitelmat/vastuuhenkilo/koti_vastuuhenkilo.html');
    }
    
    public static function vastuuhenkiloKurssit() {
        View::make('suunnitelmat/vastuuhenkilo/kurssit.html');
    }
    
    public static function vastuuhenkiloLuoKurssi() {
        View::make('suunnitelmat/vastuuhenkilo/luo_kurssi.html');
    }
    
    public static function vastuuhenkiloYhteenveto() {
        View::make('suunnitelmat/vastuuhenkilo/yhteenveto.html');
    }
    
    public static function vastuuhenkiloTikape() {
        View::make('suunnitelmat/vastuuhenkilo/tikape.html');
    }
    
    public static function vastuuhenkiloTikapeRaportti() {
        View::make('suunnitelmat/vastuuhenkilo/tikape_raportti.html');
    }

    public static function vastuuhenkiloTikapeMuokkaa() {
        View::make('suunnitelmat/vastuuhenkilo/muokkaa_kurssia.html');
    }
    
    public static function vastuuhenkiloOpettajat() {
        View::make('suunnitelmat/vastuuhenkilo/opettajat.html');
    }
    
    public static function vastuuhenkiloOpettajatArto() {
        View::make('suunnitelmat/vastuuhenkilo/arto.html');
    }
    
    public static function vastuuhenkiloOpettajatMuokkaa() {
        View::make('suunnitelmat/vastuuhenkilo/muokkaa_arto.html');
    }
    
    public static function vastuuhenkiloKysymykset() {
        View::make('suunnitelmat/vastuuhenkilo/kysymykset.html');
    }
    
    public static function vastuuhenkiloKysymyksetMuokkaa() {
        View::make('suunnitelmat/vastuuhenkilo/muokkaa_kysymys.html');
    }
    
    public static function vastuuhenkiloKysymyksetLisaa() {
        View::make('suunnitelmat/vastuuhenkilo/lisaa_kysymys.html');
    }
    
}
