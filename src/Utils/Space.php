<?php
declare(strict_types=1);

namespace OutputFormat\Utils;

enum Space: int {
    case NONE  = 3;
    case RIGHT = 0;
    case LEFT  = 1;
    case BOTH  = 2;

    // Length of space
    public function getStrlen(): int
    {
        return match($this) {
            static::NONE  => 0,
            static::BOTH  => 2,
            static::RIGHT , static::LEFT => 1
        };
    }
    
    // Just for str_pad
    public function getPadtype(): int
    {
        return match($this) {
            static::NONE  => 3,
            static::BOTH  => 2,
            static::RIGHT => 1,
            static::LEFT  => 0
        }; 
    }

    // Fill up space
    public function getSpace(?string $string, ?int $length = null) : string
    {
        $length ??= strlen($string) + $this->getStrlen();
        return str_pad($string, $length, " ", $this->getPadtype());
    }
}