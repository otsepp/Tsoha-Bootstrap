<?php

class Kurssi extends BaseModel {
    public $id, $laitos_id, $opettaja_id, $nimi, $kysely_kaynnissa;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = $this->validate_string('nimi', $this->nimi, 50);;
    }
    
    public function poista() {
        $query = DB::connection()->prepare('DELETE FROM Kurssi WHERE id=:id');
        $query->execute(array(
            'id' => $this->id
        ));
    }
    
    public function talleta() {
        $query = DB::connection()->prepare('INSERT INTO Kurssi (laitos_id, opettaja_id, nimi) VALUES (:laitos_id, :opettaja_id, :nimi) RETURNING id');
        $query->execute(array(
            'laitos_id' => $this->laitos_id,
            'opettaja_id' => $this->opettaja_id,
            'nimi' => $this->nimi
        ));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function paivita() {
        $query = DB::connection()->prepare('UPDATE Kurssi SET nimi=:nimi, opettaja_id=:opettaja_id, kysely_kaynnissa=:kysely_kaynnissa WHERE id=:id');
        $query->execute(array(
            'nimi' => $this->nimi,
            'opettaja_id' => $this->opettaja_id,
            'kysely_kaynnissa' => $this->kysely_kaynnissa,
            'id' => $this->id
        ));
    }
    
    public function haeOpettaja() {
        return Opettaja::etsi($this->opettaja_id);
    }
    
    public function osallistujenMaara() {
        $query = DB::connection()->prepare('SELECT COUNT(id) FROM Ilmoittautuminen WHERE kurssi_id=:id');
        $query->execute(array('id' => $this->id));
        $row = $query->fetch();
        return $row['count'];
    }
    
//hakee kurssit, joille oppilas ei ole ilmoittautunut
    public static function kurssitJoillaEiOppilasta($oppilas_id) { 
        $query = DB::connection()->prepare(
                'SELECT DISTINCT Kurssi.* FROM Kurssi LEFT JOIN Ilmoittautuminen ON kurssi_id = Kurssi.id '
                    . 'WHERE Kurssi.id NOT IN '
                        . '(SELECT Kurssi.id FROM Kurssi LEFT JOIN Ilmoittautuminen ON kurssi_id = Kurssi.id '
                         . 'WHERE oppilas_id = :oppilas_id)');
        $query->execute(array('oppilas_id' => $oppilas_id));
        $rows = $query->fetchAll();
        return self::luoKurssiOliot($rows);
    }
    
	//hakee kurssit, joille oppilas on ilmoittautunut, joissa kysely on käynnissä, eikä oppilas ole jo tehnyt kyselyä
    public static function kurssitJoistaOppilasVoiTehdaKyselyn($oppilas_id) { 
        $query = DB::connection()->prepare(
                'SELECT Kurssi.* From Kurssi '
                    .'JOIN Ilmoittautuminen '
                    .'ON kurssi_id=Kurssi.id '
                .'WHERE oppilas_id=:oppilas_id AND kysely_kaynnissa = 1 '
                    .'AND Kurssi.id NOT IN '
                        .'(SELECT Kurssi.id FROM Kurssi '
                        .'JOIN Kysely ON kurssi_id = Kurssi.id '
                        .'WHERE oppilas_id = :oppilas_id)');
        $query->execute(array('oppilas_id' => $oppilas_id));
        $rows = $query->fetchAll();
        return self::luoKurssiOliot($rows);
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
    
    public static function opettajanKurssitIdt($opettaja_id) {
        $query = DB::connection()->prepare('SELECT id FROM Kurssi WHERE opettaja_id=:id');
        $query->execute(array('id' => $opettaja_id));
        $rows = $query->fetchAll();
        $idt = array();
        foreach($rows as $row) {
            $idt[] = $row['id'];
        }
        return $idt;
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
                'kysely_kaynnissa' => $row['kysely_kaynnissa']
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
                    'kysely_kaynnissa' => $row['kysely_kaynnissa']
            ));
        }
        return $kurssit;
    }
    
}
