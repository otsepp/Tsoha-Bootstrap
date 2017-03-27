<?php

class Laitos extends BaseModel {
    public $id, $nimi;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    
    
    //ei tarvitse ainakaan nyt
    public static function kurssit($kurssi_id) {
        $query = DB::connection()->prepare('SELECT * FROM Kurssi WHERE laitos_id=:id');
        $query->execute(array('id' => $kurssi_id));
        $rows = $query->fetchAll();
        
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
    
    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Laitos WHERE id=:id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        $laitos = NULL;
        
        if ($row) {
            $laitos = new Laitos(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
        }
        return $laitos;
    }
}
