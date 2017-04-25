<?php

class Opettaja extends BaseModel {
    public $id, $laitos_id, $nimi, $salasana;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    
    public static function authenticate($nimi, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Opettaja WHERE nimi=:nimi AND salasana=:salasana LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'salasana' => $salasana));
        $row = $query->fetch();
        if ($row) {
            return self::luoOlio($row);
        } else {
            return null;
        }
    }
    
    public static function laitoksenOpettajat($laitos_id) {
        $query = DB::connection()->prepare('SELECT * FROM Opettaja WHERE laitos_id=:id');
        $query->execute(array('id' => $laitos_id));
        $rows = $query->fetchAll();
        return self::luoOliot($rows);
    }
    
    public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Opettaja');
        $query->execute();
        $rows = $query->fetchAll();
        return self::luoOliot($rows);
    }
    
    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Opettaja WHERE id=:id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        $opettaja = NULL;
        if ($row) {
            return self::luoOlio($row);
        }
        return $opettaja;
    }
    
     private static function luoOliot($rows) {
        $opettajat = array();
        foreach($rows as $row) {
            $opettajat[] = self::luoOlio($row);
        }
        return $opettajat;
    }
    
    private static function luoOlio($row) {
        $opettaja = new Opettaja(array(
            'id' => $row['id'],
            'laitos_id' => $row['laitos_id'],
            'nimi' => $row['nimi'],
            'salasana' => $row['salasana']
        ));
        return $opettaja;
    }
    
}
