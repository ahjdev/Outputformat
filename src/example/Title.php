<?php

include "vendor\autoload.php";

use OutputFormat\Style\OutputStyle;
use OutputFormat\Utils\Space;

$format = new OutputFormat\Format("Simple Underline Style", Space::BOTH);

echo $format->setSpace(Space::RIGHT)->Title(OutputStyle::Hang);
echo "\n\n";

echo $format->Title(OutputStyle::Double);
echo "\n\n";

echo $format->Title(OutputStyle::Dashes);
echo "\n\n";

echo $format->Title(OutputStyle::Line);
echo "\n\n";

echo $format->Title("^");
echo "\n\n";

echo $format->Title([ "╰", "-"]); // First One Is First Character