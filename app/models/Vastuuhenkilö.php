<?php

class Vastuuhenkilö extends BaseModel {
    public $id, $laitos_id, $nimi;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Vastuuhenkilö');
        $query->execute();
        $rows = $query->fetchAll();
        
        $vastuuhenkilöt = array();
        
        foreach($rows as $row) {
            $vastuuhenkilöt[] = new Vastuuhenkilö(array(
                'id' => $row['id'],
                'laitos_id' => $row['laitos_id'],
                'nimi' => $row['nimi']
            ));
        }
        return $vastuuhenkilöt;
    }
    
}
