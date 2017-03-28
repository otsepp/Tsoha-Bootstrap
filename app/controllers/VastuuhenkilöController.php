<?php


class VastuuhenkilöController extends BaseController {
        
    public static function koti() {
        $käyttäjä = Vastuuhenkilö::getTestiVH();
        View::make('vastuuhenkilö/koti.html', array('käyttäjä' => $käyttäjä));
    }
    
    public static function kurssit() {
        $käyttäjä = Vastuuhenkilö::getTestiVH();
        View::make('vastuuhenkilö/kurssit.html', array(
            'käyttäjä' => $käyttäjä,
            'kurssit' => Kurssi::laitoksenKurssit($käyttäjä->laitos_id)   
            ));
    }
    
    public static function opettajat() {
        $käyttäjä = Vastuuhenkilö::getTestiVH();
        
        $opettajat = Opettaja::laitoksenOpettajat($käyttäjä->laitos_id);
        
        View::make('vastuuhenkilö/opettajat.html', array(
            'käyttäjä' => $käyttäjä,
            'opettajat' => $opettajat
        ));
    }
    
    public static function kysymykset() {
        $käyttäjä = Vastuuhenkilö::getTestiVH();
        
        $yleisetKysymykset = Kysymys::etsiYleisetKysymykset();
        $laitosKysymykset = Kysymys::etsiLaitosKysymykset($käyttäjä->laitos_id);
        
        View::make('vastuuhenkilö/kysymykset.html', array(
            'käyttäjä' => $käyttäjä,
            'yleisetKysymykset' => $yleisetKysymykset,
            'laitosKysymykset' => $laitosKysymykset
        ));   
    }
    
    public static function uusiKysymys() {
        View::make('vastuuhenkilö/uusi_kysymys.html');
    }
}
