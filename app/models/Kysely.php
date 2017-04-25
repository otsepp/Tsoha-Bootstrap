<?php

class Kysely extends BaseModel {
  public $id, $kurssi_id, $oppilas_id, $kommentti;
  
  public function __construct($attributes) {
      parent::__construct($attributes);
      $this->validators = $this->validate_string('kommentti', $this->kommentti, 500);
  }
  
  
  public function talleta() {
      $query = DB::connection()->prepare(
              'INSERT INTO Kysely (kurssi_id, oppilas_id, kommentti) '
              .'VALUES (:kurssi_id, :oppilas_id, :kommentti) ' 
              .'RETURNING id');
      $query->execute(array(
          'kurssi_id' => $this->kurssi_id,
          'oppilas_id' => $this->oppilas_id,
          'kommentti' => $this->kommentti
      ));
      $row = $query->fetch();
      $this->id = $row['id'];
  }
  
  //Hakee kurssista tehtyjen kyselyiden kommentit
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
  
//hakee kurssin kyselyn kysymysten sisällöt, vastaukset ja niiden keskiarvot
  public static function raportti($kurssi_id) {
      $query = DB::connection()->prepare('SELECT sisalto, ROUND(AVG(arvosana),1) AS keskiarvo FROM Kysely '.
              'JOIN Kurssi ON kurssi_id = Kurssi.id '.
              'JOIN Vastaus ON kysely_id = Kysely.id '.
              'JOIN Kysymys ON kysymys_id = Kysymys.id WHERE Kysely.kurssi_id=:kurssi_id '.
              'GROUP BY sisalto, Kysymys.kurssi_id '.
              'ORDER BY Kysymys.kurssi_id DESC'
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
  
//hakee laitokset kurssien kyselyiden sisällöt, vastaukset ja niiden keskiarvot
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
