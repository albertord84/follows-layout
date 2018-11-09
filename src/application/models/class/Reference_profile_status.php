<?php

class reference_profile_status {

    const ACTIVE = 1;
    const LOCKED = 2;
    const ENDED = 3;
    const DELETED = 4;
    const MISSING = 5;
    const PRIVATED = 6;
    
    static public function Defines($const) {
        $cls = new ReflectionClass(__CLASS__);
        foreach ($cls->getConstants() as $key => $value) {
            if ($value == $const) {
                return true;
            }
        }
        return false;
    }

}
