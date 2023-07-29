<?php declare(strict_types=1);

namespace OutputFormat\Traits;

use OutputFormat\Utils\Position;
use OutputFormat\Style\OutputStyle;

trait Box
{
    /**
     * Create A Box Title
     * @param string|array|Style $style Character(s) To Underline
     * @return string 
     */
    public function Box(string|array|OutputStyle $box): string
    {
        if ($box instanceof OutputStyle)
            $box = $box->getBox();
        elseif (is_string($box))
            $box = array_fill(0, 6, $box);

        $repeat = str_repeat($box[Position::LINE_HORIZENTAL], $this->length);
        $block  = [
            $box[Position::TOP_LEFT]      . $repeat     . $box[Position::TOP_RIGHT],     // Up Side
            $box[Position::LINE_VERTICAL] . $this->text . $box[Position::LINE_VERTICAL], // Middle Side
            $box[Position::BOTTOM_LEFT]   . $repeat     . $box[Position::BOTTOM_RIGHT],  // Down Side
        ];
        return implode(PHP_EOL, $block);
    }
}