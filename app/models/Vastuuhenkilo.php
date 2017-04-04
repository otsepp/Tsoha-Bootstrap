<?php

class Vastuuhenkilo extends BaseModel {
    public $id, $laitos_id, $nimi, $salasana;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function getTestiVH() {
        $arr = Vastuuhenkilo::kaikki();
        return $arr[0];
    }
    
    public static function authenticate($nimi, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Vastuuhenkilo WHERE nimi=:nimi AND salasana=:salasana LIMIT 1');
        $query->execute(array(
           'nimi' => $nimi,
           'salasana' => $salasana
        ));
        $row = $query->fetch();
        if ($row) {
            return self::luo_olio($row);
        } else {
            return null;
        }
    }
    
    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Vastuuhenkilo WHERE id=:id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        $vastuuhenkilo = NULL;
        
        if ($row) {
            $vastuuhenkilo = self::luo_olio($row);
        }
        return $vastuuhenkilo;
    }
    
    public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Vastuuhenkilo');
        $query->execute();
        $rows = $query->fetchAll();
        
        $vastuuhenkilot = array();
        
        foreach($rows as $row) {
            $vastuuhenkilot[] = self::luo_olio($row);

        }
        return $vastuuhenkilot;
    }
    
    public static function luo_olio($row) {
        $vastuuhenkilo = new Vastuuhenkilo(array(
                'id' => $row['id'],
                'laitos_id' => $row['laitos_id'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));
        return $vastuuhenkilo;
    }
    
}
