<?php

use DrupalContribDependencies\InfoFileScanner;

require_once __DIR__ . '/vendor/autoload.php';

$results = InfoFileScanner::scan();
print_r($results);
