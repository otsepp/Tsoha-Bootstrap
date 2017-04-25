<?php

class Oppilas extends BaseModel {
    public $id, $laitos_id, $nimi;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    
    public static function authenticate($nimi, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Oppilas WHERE nimi=:nimi AND salasana=:salasana LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'salasana' => $salasana));
        $row = $query->fetch();
        if ($row) {
            return self::luoOlio($row);
        } else {
            return null;
        }
    }
    
    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Oppilas WHERE id=:id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        $oppilas = NULL;
        
        if ($row) {
            $oppilas = self::luoOlio($row);
        }
        return $oppilas;
    }
    
    public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Oppilas');
        $query->execute();
        $rows = $query->fetchAll();
        
        $oppilaat = array();
        
        foreach($rows as $row) {
            $oppilaat[] = self::luoOlio($row);
        }
        return $oppilaat;
    }
    
    private static function luoOlio($row) {
        return new Oppilas(array(
            'id' => $row['id'],
            'laitos_id' => $row['laitos_id'],
            'nimi' => $row['nimi']
        ));
    }
    
}
