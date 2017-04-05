<?php

class Kysely extends BaseModel {
  public $id, $kurssi_id, $oppilas_id, $kommentti;
  
  public function __construct($attributes) {
      parent::__construct($attributes);
  }
  
  public static function kommentit($kurssi_id) {
      $query = DB::connection()->prepare('SELECT kommentti FROM Kysely WHERE kurssi_id=:kurssi_id');
      $query->execute(array('kurssi_id' => $kurssi_id));
      $rows = $query->fetchAll();
      
      $kommentit = array();
      foreach($rows as $row) {
          $kommentit[] = $row['kommentti'];
      }
      return $kommentit;
  }
  
  public static function vastaajienMaara($kurssi_id) {
      $query = DB::connection()->prepare('SELECT COUNT(id) FROM Kysely WHERE kurssi_id=:kurssi_id');
      $query->execute(array('kurssi_id' => $kurssi_id));
      $row = $query->fetch();
      return $row['count'];
  }
  
  public static function raportti($kurssi_id) {
      $query = DB::connection()->prepare('SELECT sisalto, ROUND(AVG(arvosana),1) AS keskiarvo FROM Kysely '.
              'JOIN Kurssi ON kurssi_id = Kurssi.id '.
              'JOIN Vastaus ON kysely_id = Kysely.id '.
              'JOIN Kysymys ON kysymys_id = Kysymys.id WHERE Kysely.kurssi_id=:kurssi_id '.
              'GROUP BY sisalto'
              );
      $query->execute(array('kurssi_id' => $kurssi_id));
      $rows = $query->fetchAll();
      
      $tulokset = array();
      foreach($rows as $row) {
          $tulokset[] = array(
              'sisalto' => $row['sisalto'],
              'keskiarvo' => $row['keskiarvo']
          );
      }
      return $tulokset;
  }
  
  public static function yhteenveto($laitos_id) {
        $query = DB::connection()->prepare(' SELECT nimi, sisalto, ROUND(AVG(arvosana),1) AS keskiarvo FROM Kysely '.
                'JOIN Kurssi on kurssi_id=Kurssi.id '.
                'JOIN Vastaus ON kysely_id=Kysely.id '.
                'JOIN Kysymys on kysymys_id=Kysymys.id '.
                'WHERE Kurssi.laitos_id=:laitos_id '.
                'GROUP BY nimi, sisalto '.
                'ORDER BY nimi'
                );
        $query->execute(array(
            'laitos_id' => $laitos_id
        ));
        $rows = $query->fetchAll();
        
        $tulokset = array();
        foreach($rows as $row) {
            $tulokset[] = array(
                'nimi' => $row['nimi'],
                'sisalto' => $row['sisalto'],
                'keskiarvo' => $row['keskiarvo']
            );
        }
        return $tulokset;
    }
  
}
