<?php

class Laitos extends BaseModel {
    public $id, $nimi;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    
    public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Laitos');
        $query->execute();
        $rows = $query->fetchAll();

        $laitokset = array();
        
        foreach($rows as $row) {
            $laitokset[] = self::luoOlio($row);
        }
        return $laitokset;
    }
    
    public static function kurssit($kurssi_id) {
        $query = DB::connection()->prepare('SELECT * FROM Kurssi WHERE laitos_id=:id');
        $query->execute(array('id' => $kurssi_id));
        $rows = $query->fetchAll();
        
        $kurssit = array();
        
        foreach($rows as $row) {
            $kurssit[] = Kurssi::luoOlio($row);
        }
        return $kurssit;
    }
    
    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Laitos WHERE id=:id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        $laitos = NULL;
        
        if ($row) {
            $laitos = self::luoOlio($row);
        }
        return $laitos;
    }
    
    private static function luoOlio($row) {
        return new Laitos(array(
           'id' => $row['id'],
           'nimi' => $row['nimi'] 
        ));
    }
   
}
