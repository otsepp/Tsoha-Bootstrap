<?php

class Kysymys extends BaseModel {
    public $id, $laitos_id, $kurssi_id, $sisältö;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
}
