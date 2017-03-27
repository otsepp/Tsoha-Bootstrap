<?php

class Ilmoittautuminen extends BaseModel {
    public $id, $kurssi_id, $oppilas_id;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    } 
        
    
}
