<?php

include "vendor/autoload.php";

use OutputFormat\Utils\Position;
use OutputFormat\Style\OutputStyle;
use OutputFormat\Utils\Space;

$format = new OutputFormat\Format("BoxTitle For Test", Space::BOTH);

echo $format->Box(OutputStyle::Dashes);
echo PHP_EOL;

echo $format->Box(OutputStyle::Double);
echo PHP_EOL;

echo $format->Box(OutputStyle::Line);
echo PHP_EOL;

echo $format->Box(OutputStyle::Hang);
echo PHP_EOL;

echo $format->Box("*");
echo PHP_EOL;

echo $format->Box([
    Position::LINE_HORIZENTAL => '*',
    Position::LINE_VERTICAL   => '|',
    Position::TOP_LEFT        => 1,
    Position::TOP_RIGHT       => 2,
    Position::BOTTOM_LEFT     => 3,
    Position::BOTTOM_RIGHT    => 4,
]);