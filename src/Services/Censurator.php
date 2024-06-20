<?php

namespace App\Services;

class Censurator
{
    const BAN_WORDS = ['fraise', 'edulcorant', 'nutella', 'chocolatine'];

    public function purify(?string $text): ?string
    {
        if($text){
            $text = str_ireplace(self::BAN_WORDS, "******", $text);
        }
       return $text;
    }

}