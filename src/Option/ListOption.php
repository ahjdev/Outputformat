<?php
declare(strict_types=1);

namespace OutputFormat\Option;

use OutputFormat\Style\OutputStyle;
use OutputFormat\Utils\Space;

class ListOption
{
    private string $spreator = ": ";
    private bool   $keys     = false;
    private bool   $align    = true;
    private Space  $space    = Space::NONE;
    private OutputStyle|string|array $style = "";
    
    /**
     * Include array keys?
     *
     * @param boolean $keys
     * @return self
     */
    public function includeKey(bool $keys): self
    {
        $this->keys = $keys;
        return $this;       
    }
    
    /**
     * Align output ?
     *
     * @param boolean $align
     * @return self
     */
    public function align(bool $align): self
    {
        $this->align = $align;
        return $this;   
    }

    /**
     * Spreator array keys & values
     *
     * @param string $spreator
     * @return self
     */
    public function setSpreator(string $spreator): self
    {
        $this->spreator = $spreator;
        return $this;  
    }

    /**
     * Set style
     *
     * @param OutputStyle|string|array $style
     * @return self
     */
    public function setStyle(OutputStyle|string|array $style): self
    {
        $this->style = $style;
        return $this;  
    }
    
    /**
     * Set space
     *
     * @param Space $space
     * @return self
     */
    public function setSpace(Space $space): self
    {
        $this->space = $space;
        return $this;
    }

    public function getIncludeKey(array $list): array
    {
        return $this->keys ? array_keys($list) : [];
    }
    
    public function getAlign(array $list): array
    {
        return $this->align ? $this->alignArray($list) : $list;
    }

    public function getPrefix(?string $text): string|array
    {
        if (is_string($this->style))
            $prefix = array_fill(0, 3, $this->space->getSpace($this->style));

        elseif ($this->style instanceof OutputStyle) {
            $prefix = $this->style->getPrefix(
                $text,
                $this->space
            );
        }
        return $prefix;
    }
    
    public function getSpreator(): string
    {
        return $this->spreator;
    }

    public function getStyle(string $title): OutputStyle|string|array
    {
        if($this->style instanceof OutputStyle)
            return $this->style->getTitleList($title);
        return $title;
    }

    public function getSpace(): Space
    {
        return $this->space;
    }

    private function alignArray(array $args): array
    {
        [ $result, $maxLength ] = [ [], 0 ];
        $keys = array_keys($args);
        $maxLength = max(array_map('mb_strlen', $keys));
        foreach ($args as $key => $val) {
            $key .= str_pad('', $maxLength - mb_strlen((string) $key), pad_type: STR_PAD_LEFT);
            $result[$key] = $val;
        }
        return $result;
    }
}