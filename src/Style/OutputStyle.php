<?php declare(strict_types=1);

namespace OutputFormat\Style;

use OutputFormat\Format;
use OutputFormat\Utils\Space;
use OutputFormat\Exception\OutputException;

enum OutputStyle {
    case Bullet;
    case Line;
    case Box;
    case Hang;
    case Double;
    case Dashes;

    public function getPrefix(?string $title, Space $space): array
    {
        $return = match ($this) {
            static::Bullet => array_fill(0, 3, '•'),
            static::Box  ,
            static::Hang ,
            static::Line => empty($title) ? [ '╭', '├', '╰' ] : [ '├', '├', '╰' ],
            default => throw new OutputException("Unhandled List Type")
        };
        return array_map($space->getSpace(...), $return);
    }

    public function getTitleList(?string $title): string
    {
        if (empty($title))
            return '';
        return match ($this)
        {
            static::Bullet => $title,
            static::Box    => (new Format($title))->Box(OutputStyle::Hang),
            static::Hang,
            static::Line   => (new Format($title))->Title(OutputStyle::Hang)
        };
    }

    /**
     * Use for Title method
     *
     * @return string|array
     */
    public function getTitle(): string|array
    {
        return match($this) {
            static::Double => '═',
            static::Dashes => '╌',
            static::Line   => '─',
            static::Bullet => '•',
            static::Hang   => [ '╭', '─' ],
            default => throw new OutputException("Unhandled Title Type")
        };
    }
    
    /**
     * Use for Box method
     *
     * @return array
     */
    public function getBox(): array
    {
        return match($this)
        {
            static::Double => [
                '═', // LINE_HORIZENTAL
                '║', // LINE_VERTICAL
                '╔', // TOP_LEFT 
                '╗', // TOP_RIGHT
                '╚', // BOTTOM_LEFT
                '╝', // BOTTOM_RIGHT
            ],
            static::Dashes => [
                '╌',
                '┊',
                '╭', 
                '╮',
                '╰',
                '╯',
            ],

            static::Line   => [
                '─',
                '│',
                '╭',
                '╮',
                '╰',
                '╯',
            ],
            static::Hang  => [
                '─',
                '│',
                '╭',
                '╮', 
                '├',
                '╯',
            ],
            default => throw new OutputException("Unhandled Box Type")
        };
    }
}