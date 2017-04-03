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
  
  $routes->get('/vastuuhenkilo/kurssit/uusi', function() {
      VastuuhenkiloController::uusiKurssi();
  });
  
  $routes->post('/vastuuhenkilo/uusi_kurssi', function() {
      KurssiController::luoKurssi();
  });
  
  $routes->get('/vastuuhenkilo/opettajat', function() {
      VastuuhenkiloController::opettajat();
  });
  
  $routes->get('/vastuuhenkilo/opettajat/uusi', function() {
      VastuuhenkiloController::uusiOpettaja();
  });
  
  $routes->post('/vastuuhenkilo/uusi_opettaja', function() {
      OpettajaController::luoOpettaja();
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
  