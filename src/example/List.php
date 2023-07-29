<?php

include "vendor\autoload.php";

use OutputFormat\Style\OutputStyle;
use OutputFormat\Option\ListOption;
use OutputFormat\Utils\Space;

$format = (new OutputFormat\Format('aha', Space::BOTH));

echo $format->List(["Item A", "Item B", "Item C", "Item D"], OutputStyle::Line);
echo "\n\n";

echo $format->List(["Item A", "Item B", "Item C", "Item D"], OutputStyle::Box);
echo "\n\n";

echo $format->List(["Item A", "Item B", "Item C", "Item D"], OutputStyle::Bullet);
echo "\n\n";

$option = (new ListOption())
    ->align(true)
    ->includeKey(true)
    ->setSpace(Space::RIGHT)
    ->setStyle(OutputStyle::Line)
    ->setSpreator(" : ");

echo $format->List([
    'item1'  => 'object1',
    'item2'  => 'object2',
    'item-n' => 'object-n'
], $option);
