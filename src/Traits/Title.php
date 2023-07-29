<?php declare(strict_types=1);

namespace OutputFormat\Traits;

use OutputFormat\Style\OutputStyle;

trait Title
{
    /**
     * Underline The Text
     * @param string|array|Style $style Character(s) To Underline
     * @return string
     */
    public function Title(string|array|OutputStyle $style): string
    {
        [ $repeat, $strlen ] = [ '', $this->length ];

        if ($style instanceof OutputStyle)
            $style = $style->getTitle();

        if (is_array($style)) {
            [$repeat, $style] = $style;
            $strlen -= 1;
        }

        $repeat .= str_repeat($style, $strlen);
        return $this->title . PHP_EOL . $repeat;
    }
}