<?php

class Kysymys extends BaseModel {
    public $id, $laitos_id, $kurssi_id, $sisalto;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = $this->validate_string('sisalto', $this->sisalto, 50);
    }
    
    public function poista() {
        $query = DB::connection()->prepare('DELETE FROM Kysymys WHERE id=:id');
        $query->execute(array(
            'id' => $this->id
        ));
    }
    
     public function talleta() {
        $query = DB::connection()->prepare("INSERT INTO Kysymys (sisalto, laitos_id, kurssi_id) VALUES (:sisalto, :laitos_id, :kurssi_id) RETURNING id");
        $query->execute(array('sisalto' => $this->sisalto, 
            'laitos_id' => $this->laitos_id,
            'kurssi_id' => $this->kurssi_id
                ));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
	//kysymykset, jotka esiintyvät kaikissa kyselyissä
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
                'sisalto' => $row['sisalto']
            ));
        }
        return $kysymykset;
    }
    
}
