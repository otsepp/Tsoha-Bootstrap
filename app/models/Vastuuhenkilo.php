<?php

class Vastuuhenkilo extends BaseModel {
    public $id, $laitos_id, $nimi, $salasana;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    
    public static function authenticate($nimi, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Vastuuhenkilo WHERE nimi=:nimi AND salasana=:salasana LIMIT 1');
        $query->execute(array(
           'nimi' => $nimi,
           'salasana' => $salasana
        ));
        $row = $query->fetch();
        if ($row) {
            return self::luoOlio($row);
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
            $vastuuhenkilo = self::luoOlio($row);
        }
        return $vastuuhenkilo;
    }
    
    public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Vastuuhenkilo');
        $query->execute();
        $rows = $query->fetchAll();
        
        $vastuuhenkilot = array();
        
        foreach($rows as $row) {
            $vastuuhenkilot[] = self::luoOlio($row);

        }
        return $vastuuhenkilot;
    }
    
    private static function luoOlio($row) {
        $vastuuhenkilo = new Vastuuhenkilo(array(
                'id' => $row['id'],
                'laitos_id' => $row['laitos_id'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));
        return $vastuuhenkilo;
    }
    
}
