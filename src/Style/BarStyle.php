<?php declare(strict_types=1);

namespace OutputFormat\Style;

enum BarStyle
{
    case Block;
    case Battery;
    case Bar;
    case Circle;

    public function getBarStyle()
    {
        return match ($this) {
            static::Block   => [ 'empty' => '░', 'fill' => '▓' ],
            static::Bar     => [ 'empty' => ' ', 'fill' => '■' ],
            static::Battery => [ 'empty' => ' ', 'fill' => '█' ],
            static::Circle  => [ 'empty' => '○', 'fill' => '●' ],
        };
    }

    public function getPrefix($default)
    {
        return match ($this) {
            static::Bar     => '[',
            static::Battery => '┫',
            default => $default
        };
    }

    public function getSuffix($default)
    {
        return match ($this) {
            static::Bar     => ']',
            static::Battery => '┣',
            default => $default
        };
    }


}