<?php


class VastuuhenkiloController extends BaseController {
        
    public static function koti() {
        $kayttaja = Vastuuhenkilo::getTestiVH();
        View::make('vastuuhenkilö/koti.html', array('kayttaja' => $kayttaja));
    }
    
    public static function kurssit() {
        $kayttaja = Vastuuhenkilo::getTestiVH();
        View::make('vastuuhenkilö/kurssit.html', array(
            'kayttaja' => $kayttaja,
            'kurssit' => Kurssi::laitoksenKurssit($kayttaja->laitos_id)   
            ));
    }
    
    public static function uusiKurssi() {
        $kayttaja = Vastuuhenkilo::getTestiVH();
        $opettajat = Opettaja::laitoksenOpettajat($kayttaja->laitos_id);
        View::make('vastuuhenkilö/uusi_kurssi.html', array(
            'kayttaja' => $kayttaja,
            'opettajat' => $opettajat
        ));
    }
    
    public static function opettajat() {
        $kayttaja = Vastuuhenkilo::getTestiVH();
        
        $opettajat = Opettaja::laitoksenOpettajat($kayttaja->laitos_id);
        
        View::make('vastuuhenkilö/opettajat.html', array(
            'kayttaja' => $kayttaja,
            'opettajat' => $opettajat
        ));
        
    }
    
    public static function uusiOpettaja() {
        $kayttaja = Vastuuhenkilo::getTestiVH();
        View::make('vastuuhenkilö/uusi_opettaja.html', array(
            'kayttaja' => $kayttaja
        ));
    }
    
    public static function kysymykset() {
        $kayttaja = Vastuuhenkilo::getTestiVH();
        
        $yleisetKysymykset = Kysymys::etsiYleisetKysymykset();
        $laitosKysymykset = Kysymys::etsiLaitosKysymykset($kayttaja->laitos_id);
        
        View::make('vastuuhenkilö/kysymykset.html', array(
            'kayttaja' => $kayttaja,
            'yleisetKysymykset' => $yleisetKysymykset,
            'laitosKysymykset' => $laitosKysymykset
        ));   
    }
    
    public static function uusiKysymys() {
        $kayttaja = Vastuuhenkilo::getTestiVH();
        View::make('vastuuhenkilö/uusi_kysymys.html', array(
            'kayttaja' => $kayttaja
        ));
    }
}
