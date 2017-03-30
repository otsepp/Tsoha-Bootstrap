<?php

class Vastuuhenkilo extends BaseModel {
    public $id, $laitos_id, $nimi;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function getTestiVH() {
        $arr = Vastuuhenkilo::kaikki();
        return $arr[0];
    }
    
    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Vastuuhenkilo WHERE id=:id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        $vastuuhenkilo = NULL;
        
        if ($row) {
            $vastuuhenkilo = new Vastuuhenkilo(array(
                'id' => $row['id'],
                'laitos_id' => $row['laitos_id'],
                'nimi' => $row['nimi']
            ));
        }
        return $vastuuhenkilo;
    }
    
    public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Vastuuhenkilo');
        $query->execute();
        $rows = $query->fetchAll();
        
        $vastuuhenkilot = array();
        
        foreach($rows as $row) {
            $vastuuhenkilot[] = new Vastuuhenkilo(array(
                'id' => $row['id'],
                'laitos_id' => $row['laitos_id'],
                'nimi' => $row['nimi']
            ));
        }
        return $vastuuhenkilot;
    }
    
}
