<?php

class Kurssi extends BaseModel {
    public $id, $laitos_id, $opettaja_id, $nimi, $kysely_käynnissä;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public function haeOpettaja() {
        return Opettaja::etsi($this->opettaja_id);
    }
    
    public function osallistujenMäärä() {
        $query = DB::connection()->prepare('SELECT COUNT(id) FROM Ilmoittautuminen WHERE id=:id');
        $query->execute(array('id' => $this->id));
        $row = $query->fetch();
        return $row['count'];
    }
    
    public static function laitoksenKurssit($laitos_id) {
        $query = DB::connection()->prepare('SELECT * FROM Kurssi WHERE laitos_id=:id');
        $query->execute(array('id' => $laitos_id));
        $rows = $query->fetchAll();
        return self::luoKurssiOliot($rows);
    }
    
    public static function opettajanKurssit($opettaja_id) {
        $query = DB::connection()->prepare('SELECT * FROM Kurssi WHERE opettaja_id=:id');
        $query->execute(array('id' => $opettaja_id));
        $rows = $query->fetchAll();
        return self::luoKurssiOliot($rows);
    }

    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kurssi WHERE id=:id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        $kurssi = NULL;
        
        if ($row) {
            $kurssi = new Kurssi(array(
                'id' => $row['id'],
                'laitos_id' => $row['laitos_id'],
                'opettaja_id' => $row['opettaja_id'],
                'nimi' => $row['nimi'],
                'kysely_käynnissä' => $row['kysely_käynnissä']
            ));
        }
        return $kurssi;
    }

    private static function luoKurssiOliot($rows) {
        $kurssit = array();
        foreach($rows as $row) {
            $kurssit[] = new Kurssi(array(
                    'id' => $row['id'],
                    'laitos_id' => $row['laitos_id'],
                    'opettaja_id' => $row['opettaja_id'],
                    'nimi' => $row['nimi'],
                    'kysely_käynnissä' => $row['kysely_käynnissä']
            ));
        }
        return $kurssit;
    }
    
}
