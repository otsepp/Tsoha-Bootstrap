<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/aloitus', function() {
      HelloWorldController::aloitus();
  });
  
  $routes->post('/logout', function() {
      BaseController::logout();
  });
  
  $routes->get('/vastuuhenkilo/login', function() {
      VastuuhenkiloController::login();
  });
  
  $routes->get('/vastuuhenkilo/koti', function() {
      VastuuhenkiloController::koti();
  });
  
  $routes->post('/vastuuhenkilo/login', function() {
      VastuuhenkiloController::handle_login();
  });
  
  $routes->get('/vastuuhenkilo/kurssit/yhteenveto', function() {
      VastuuhenkiloController::kurssitYhteenveto();
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
  
  $routes->get('/vastuuhenkilo/muokkaa_kurssia/:id', function($id) {
      VastuuhenkiloController::muokkaaKurssia($id);
  });
  
  $routes->post('/vastuuhenkilo/muokkaa_kurssia/:id', function($id) {
      KurssiController::paivita($id);
  });
  
  $routes->get('/vastuuhenkilo/opettajat', function() {
      VastuuhenkiloController::opettajat();
  });
  
  $routes->get('/vastuuhenkilo/kysymykset', function() {
      VastuuhenkiloController::kysymykset();
  });
  
  $routes->post('/vastuuhenkilo/kysymykset/poista/:id', function($id) {
      KysymysController::poista($id);
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
  
  $routes->get('/kurssi/:id/raportti', function($id) {      
      KurssiController::raportti($id);
  });
  
  $routes->get('/opettaja/:id', function($id) {
      OpettajaController::näytä($id);
  });
  