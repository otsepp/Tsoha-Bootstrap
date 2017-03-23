<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  
  //static sivut
  
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
  
  $routes->get('/vastuuhenkilo_yhteenveto', function() {
      staticVastuuHenkiloController::vastuuhenkiloYhteenveto();
  });
  
  $routes->get('/vastuuhenkilo_tikape', function() {
      staticVastuuHenkiloController::vastuuhenkiloTikape();
  });
  
  $routes->get('/vastuuhenkilo_opettajat', function() {
      staticVastuuHenkiloController::vastuuhenkiloOpettajat();
  });
  
  $routes->get('/vastuuhenkilo_kysymykset', function() {
      staticVastuuHenkiloController::vastuuhenkiloKysymykset();
  });
  