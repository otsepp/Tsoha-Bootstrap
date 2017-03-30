<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/kirjautuminen', function() {
      HelloWorldController::kirjautuminen();
  });
  
  $routes->get('/vastuuhenkilo/koti', function() {
      VastuuhenkiloController::koti();
  });
  
  $routes->get('/vastuuhenkilo/kurssit', function() {
      VastuuhenkiloController::kurssit();
  });
  
  $routes->get('/vastuuhenkilo/opettajat', function() {
      VastuuhenkiloController::opettajat();
  });
  
  $routes->get('/vastuuhenkilo/kysymykset', function() {
      VastuuhenkiloController::kysymykset();
  });
  
  $routes->get('/vastuuhenkilo/kysymykset/uusi', function() {
      VastuuhenkiloController::uusiKysymys();
  });
  
  $routes->post('/uusi_yleinen_kysymys', function() {
      KysymysController::luoYleinenKysymys();
  });
  
  $routes->post('/uusi_laitoskysymys', function() {
      KysymysController::luoLaitosKysymys();
  });
  
  $routes->get('/kurssi/:id', function($id) {      
      KurssiController::näytä($id);
  });
  
  $routes->get('/opettaja/:id', function($id) {
      OpettajaController::näytä($id);
  });
  
  //static sivut
  /*
  $routes->get('/etusivu', function() {
    HelloWorldController::etusivu();
  });

  $routes->get('/koti_oppilas', function() {
    HelloWorldController::kotiOppilas();
  });
  
  $routes->get('/kysely_tikape', function() {
    HelloWorldController::kyselyTikape();
  });
  
  
  $routes->get('/koti_opettaja', function() {
    staticOpettajaController::kotiOpettaja();
  });
  
  $routes->get('/opettaja_tikape', function() {
    staticOpettajaController::opettajaTikape();
  });
  
  $routes->get('/opettaja_tikape_raportti', function() {
    staticOpettajaController::opettajaTikapeRaportti();
  });
  
  $routes->get('/opettaja_tito', function() {
    staticOpettajaController::opettajaTito();
  });
  
  $routes->get('/opettaja_tito_luo_kysely', function() {
    staticOpettajaController::opettajaTitoLuoKysely();
  });
  
  $routes->get('/opettaja_webdevving', function() {
    staticOpettajaController::opettajaWebdevving();
  });
  
  $routes->get('/opettaja_webdevving_muokkaa_kysely_webdevving', function() {
    staticOpettajaController::opettajaWebdevvingMuokkaaKyselya();
  });

  $routes->get('/opettaja_webdevving_paivita_kysymyksia', function() {
    staticOpettajaController::opettajaWebdevvingPaivitaKysmyksia();
  });
  
  $routes->get('/opettaja_webdevving_lisaa_kysymyksia', function() {
    staticOpettajaController::opettajaWebdevvingLisaaKysmyksia();
  });
  
  
  $routes->get('/koti_vastuuhenkilo', function() {
      staticVastuuHenkiloController::kotiVastuuhenkilo();
  });
  
  $routes->get('/vastuuhenkilo_kurssit', function() {
      staticVastuuHenkiloController::vastuuhenkiloKurssit();
  });
  
  $routes->get('/vastuuhenkilo_luo_kurssi', function() {
      staticVastuuHenkiloController::vastuuhenkiloLuoKurssi();
  });
  
  $routes->get('/vastuuhenkilo_yhteenveto', function() {
      staticVastuuHenkiloController::vastuuhenkiloYhteenveto();
  });
  
  $routes->get('/vastuuhenkilo_tikape', function() {
      staticVastuuHenkiloController::vastuuhenkiloTikape();
  });
  
  $routes->get('/vastuuhenkilo_tikape_raportti', function() {
      staticVastuuHenkiloController::vastuuhenkiloTikapeRaportti();
  });
  
  $routes->get('/vastuuhenkilo_tikape_muokkaa', function() {
      staticVastuuHenkiloController::vastuuhenkiloTikapeMuokkaa();
  });
  
  $routes->get('/vastuuhenkilo_opettajat', function() {
      staticVastuuHenkiloController::vastuuhenkiloOpettajat();
  });
  
  $routes->get('/vastuuhenkilo_opettajat_arto', function() {
      staticVastuuHenkiloController::vastuuhenkiloOpettajatArto();
  });
  
  $routes->get('/vastuuhenkilo_opettajat_muokkaa', function() {
      staticVastuuHenkiloController::vastuuhenkiloOpettajatMuokkaa();
  });
  
  $routes->get('/vastuuhenkilo_kysymykset', function() {
      staticVastuuHenkiloController::vastuuhenkiloKysymykset();
  });
  
  $routes->get('/vastuuhenkilo_kysymykset_muokkaa', function() {
      staticVastuuHenkiloController::vastuuhenkiloKysymyksetMuokkaa();
  });
  
  $routes->get('/vastuuhenkilo_kysymykset_lisaa', function() {
      staticVastuuHenkiloController::vastuuhenkiloKysymyksetLisaa();
  });
  
  */
  