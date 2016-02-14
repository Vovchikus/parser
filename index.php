<?php

require 'vendor/autoload.php';

use Parser\DataParser\Parser;

$parser = new Parser();
$parser->parseAttribute('good.xml', 'offer');
