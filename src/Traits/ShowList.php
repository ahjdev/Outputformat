<?php
declare(strict_types=1);

namespace OutputFormat\Traits;

use OutputFormat\Option\ListOption;
use OutputFormat\Style\OutputStyle;

trait ShowList
{
    public function List(array $list, ListOption|OutputStyle|string|array $option = null): string
    {
        if (!$option instanceof ListOption)
            $option = (new ListOption())->setStyle($option);
        $title   = $this->title;
        $implode = '';
        $prefix  = $option?->getPrefix($title) ?? '';
        $list    = $option?->getAlign($list)   ?? $list;
        $title   = $option?->getStyle($title)  ?? $title;
        $implode .= $this->makeList($list, $prefix, $option);
        return $title . $implode;
    }

    /**
     * Helper Function For showList method
     * @param array $list Array of Lists
     * @param array|string $prefix Prefix To List
     * @param string $spreator Character To Spreate Lists
     * @param bool $keys Include Key Value In Return String
     * @return string
     */
    private function makeList(array $list, array|string $prefix, ?ListOption $option = null): string
    {
        $prefix = array_map(fn($val) => PHP_EOL . $val, $prefix);
        // Include Keys
        $keys = $option?->getIncludeKey($list) ?? [];

        // Spreate Array Key & Value
        $spreator = $option?->getSpreator() ?? '';
        $spreate  = $this->spreateArray($list, $keys, $spreator);
        // explode first and last
        $first = $prefix[0] . array_shift($spreate) . $prefix[1];
        $last  = $prefix[2] . array_pop($spreate);
        return $first . implode($prefix[1], $spreate) . $last;
    }

    private function spreateArray(array $list, array $keys, string $spreator)
    {
        return array_map(
            function ($keys, $values) use ($spreator) {
                if (empty($keys))
                    return $values;
                return $keys . $spreator . $values;
            }, $keys, $list
        );
    }
}