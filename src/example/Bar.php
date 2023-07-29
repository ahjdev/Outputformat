<?php

include "vendor/autoload.php";

use OutputFormat\Option\BarOption;
use OutputFormat\Style\BarStyle;
use OutputFormat\Utils\Space;

$format = new OutputFormat\Format("BoxTitle For Test", Space::BOTH);
$option = (new BarOption())
    ->setAffix(['{', '}'])
    ->setStyle(BarStyle::Battery)
    ->showPercent(true)
    ->showValue(true);

echo $format->Bar(35, 50, $option);
//------------------------

echo PHP_EOL;
echo $format->Bar(35, 50, $option->setStyle(BarStyle::Block)->showPercent(false));
//------------------------

echo PHP_EOL;
echo $format->Bar(35, 50, $option->setStyle(BarStyle::Bar)->length(50)->showPercent(false));
//------------------------

echo PHP_EOL;
echo $format->Bar(35, 50, $option);
$option = $option->setStyle(BarStyle::Circle)->showPercent(false)->length(15);
//------------------------

$option = $option->setStyle(['■', '○'])->showValue(false)->length(15);
echo PHP_EOL;
echo $format->Bar(35, 50, $option);