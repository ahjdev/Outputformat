<?php
declare(strict_types=1);

namespace OutputFormat\Option;

use OutputFormat\Exception\OutputException;
use OutputFormat\Style\BarStyle;

class BarOption
{
    private BarStyle|array $style = ['', ''];
    private array $affix  = ['', ''];
    private int  $length  = 10;
    private bool $percent = false;
    private bool $value   = false;
    
    /**
     * Set maximum characters
     *
     * @param integer $length
     * @return self
     */
    public function length(int $length): self
    {   
        $this->length = $length;
        return $this;
    }
    
    /**
     * Style of progress bar
     *
     * @param BarStyle|array $style
     * @return self
     */
    public function setStyle(BarStyle|array $style): self
    {
        if (is_array($style))
        {
            if (empty($affix))
                throw new OutputException('EMPTY_ARRAY');
            if (count($affix) == 1)
                $affix = array_fill(0, 2, $affix);
        }
        $this->style = [ $style[0], $style[1] ];
        return $this;
    }
    
    /**
     * show "%" or not in output
     *
     * @param boolean $percent
     * @return self
     */
    public function showPercent(bool $percent): self
    {
        $this->percent = $percent;
        return $this;
    }
    
    /**
     * show amount or not in output
     *
     * @param boolean $value
     * @return self
     */
    public function showValue(bool $value): self
    {
        $this->value = $value;
        return $this;
    }
    
    /**
     * Set Prefix and Suffix
     *
     * @param array $affix
     * @return self
     */
    public function setAffix(array $affix): self
    {   
        if (empty($affix))
            throw new OutputException('EMPTY_ARRAY');
        if (count($affix) == 1)
            $affix = array_fill(0, 2, $affix);

        $this->affix = [ $affix[0], $affix[1] ];
        return $this;
    }

    /**
     * Showing the progress
     *
     * @param integer|float $min Passed
     * @param integer|float $max All
     * @return string
     */
    public function getProgress(int|float $min, int|float $max): string
    {
        $percent = $this->percent ? ($min * 100)/$max : 0;
        $passed  = (int) round($min / $max * $this->length);
        $remain  = (int) $this->length - $passed;
        $getBar  = $this->getBar($passed, $remain);
        $getBar .= $this->value   ? " $min/$max"   : '';
        $getBar .= $this->percent ? " ($percent%)" : '';
        return $getBar;
    }

    /**
     * Beauty numbers
     *
     * @param int $fill
     * @param int $empty
     * @return string
     */
    private function getBar(int $fill, int $empty): string
    {
        $result  = '';
        $result .= $this->getPrefix();
        $result .= $this->getFill($fill);
        $result .= $this->getEmpty($empty);
        $result .= $this->getSuffix();
        return $result;
    }
    
    /**
     * Fill number with style
     *
     * @param integer $empty
     * @return string
     */
    private function getEmpty(int $empty): string
    {
        if ($this->style instanceof BarStyle)
        $block = $this->style->getBarStyle()['empty'];
        else
        $block = $this->style[1];
        return str_repeat($block, $empty);
    }
    
    /**
     * Fill passed with style
     *
     * @param integer $fill
     * @return string
     */
    private function getFill(int $fill): string
    {
        if ($this->style instanceof BarStyle)
        $block = $this->style->getBarStyle()['fill'];
        else
        $block = $this->style[0];
        return str_repeat($block, $fill);
    }

    private function getPrefix()
    {
        $default = $this->affix[0] ?? '';
        if ($this->style instanceof BarStyle) {
            return $this->style->getPrefix($default);
        }
        return $default;
    }

    private function getSuffix()
    {
        $default = $this->affix[1] ?? '';
        if ($this->style instanceof BarStyle) {
            return $this->style->getSuffix($default);
        }
        return $default;
    }
}