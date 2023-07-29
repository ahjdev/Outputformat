<?php declare(strict_types=1);

namespace OutputFormat\Traits;

use OutputFormat\Option\BarOption;

trait Bar
{
    public function Bar(int|float $min, int|float $max, BarOption $option)
    {
        return $option->getProgress($min, $max);
    }
}