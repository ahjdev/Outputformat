<?php declare(strict_types=1);

namespace OutputFormat;

use OutputFormat\Utils\Space;
use OutputFormat\Style\OutputStyle;
use OutputFormat\Traits\Bar;
use OutputFormat\Traits\Box;
use OutputFormat\Traits\Title;
use OutputFormat\Traits\ShowList;

final class Format
{
    use Title, Box, Bar, ShowList;
    private int    $length;
    private string $defaultText;
    /**
     *
     * @param string|null $text Title header, could be null
     * @param [type] $space
     */
    public function __construct(private ?string $title = '', private Space $space = Space::NONE)
    {
        $this->defaultText = $title;
        $this->setSpace($space);
    }

    /**
     * Set space for title
     *
     * @param Space $space
     * @return self
     */
    public function setSpace(Space $space):self
    {
        $this->length = mb_strlen($this->defaultText) + $space->getStrlen();
        if (!empty($this->defaultText))
            $this->title = $space->getSpace($this->defaultText, $this->length);
        return $this;
    }
}