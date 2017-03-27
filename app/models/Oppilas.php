<?php

class Oppilas extends BaseModel {
    public $id, $laitos_id, $nimi;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Oppilas');
        $query->execute();
        $rows = $query->fetchAll();
        
        $oppilaat = array();
        
        foreach($rows as $row) {
            $oppilaat[] = new Oppilas(array(
                'id' => $row['id'],
                'laitos_id' => $row['laitos_id'],
                'nimi' => $row['nimi']
            ));
        }
        return $oppilaat;
    }
    
}
