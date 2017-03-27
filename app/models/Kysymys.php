<?php

class Kysymys extends BaseModel {
    public $id, $laitos_id, $kurssi_id, $sisältö;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function etsiYleisetKysymykset() {
        $query = DB::connection()->prepare('SELECT * FROM Kysymys WHERE laitos_id IS NULL AND kurssi_id IS NULL');
        $query->execute();
        $rows = $query->fetchAll();
        return self::luoKysymysOliot($rows);
    }
    
    public static function etsiLaitosKysymykset($laitos_id) {
        $query = DB::connection()->prepare('SELECT * FROM Kysymys WHERE laitos_id=:id');
        $query->execute(array('id' => $laitos_id));
        $rows = $query->fetchAll();
        return self::luoKysymysOliot($rows);
    }
    
    public static function etsiKurssiKysymykset($kurssi_id) {
        $query = DB::connection()->prepare('SELECT * FROM Kysymys WHERE kurssi_id=:id');
        $query->execute(array('id' => $kurssi_id));
        $rows = $query->fetchAll();
        return self::luoKysymysOliot($rows);
    }
    
    private static function luoKysymysOliot($rows) {
        $kysymykset = array();
        foreach($rows as $row) {
            $kysymykset[] = new Kysymys(array(
                'id' => $row['id'],
                'laitos_id' => $row['laitos_id'],
                'kurssi_id' => $row['kurssi_id'],
                'sisältö' => $row['sisältö']
            ));
        }
        return $kysymykset;
    }
    
}
