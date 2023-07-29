<?php
declare(strict_types=1);

namespace OutputFormat\Utils;

enum Position: int
{
    const LINE_HORIZENTAL = 0;
    const LINE_VERTICAL   = 1;
    const TOP_LEFT        = 2;
    const TOP_RIGHT       = 3;
    const BOTTOM_LEFT     = 4;
    const BOTTOM_RIGHT    = 5;
}