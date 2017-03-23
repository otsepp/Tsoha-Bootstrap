<?php


class staticOpettajaController {

    public static function kotiOpettaja() {
        View::make('suunnitelmat/opettaja/koti_opettaja.html');
    }
    
    public static function opettajaTikape() {
        View::make('suunnitelmat/opettaja/tikape.html');
    }
    
    public static function opettajaTikapeRaportti() {
        View::make('suunnitelmat/opettaja/tikape_raportti.html');
    }
    
    public static function opettajaTito() {
        View::make('suunnitelmat/opettaja/tito.html');
    }
    
     public static function opettajaTitoLuoKysely() {
        View::make('suunnitelmat/opettaja/luo_kysely_tito.html');
    }
    
    public static function opettajaWebdevving() {
        View::make('suunnitelmat/opettaja/webdevving.html');
    }
    
    public static function opettajaWebdevvingMuokkaaKyselya() {
        View::make('suunnitelmat/opettaja/muokkaa_kysely_webdev.html');
    }
    
    public static function opettajaWebdevvingPaivitaKysmyksia() {
        View::make('suunnitelmat/opettaja/paivita_kysymyksia.html');
    }
    
    public static function opettajaWebdevvingLisaaKysmyksia() {
        View::make('suunnitelmat/opettaja/lisaa_kysymyksia.html');
    }
    
}
