<?php

use Composer\Semver\VersionParser;

require_once __DIR__ . '/vendor/autoload.php';

$parser = new VersionParser();
$constraints = $parser->parseConstraints('>=1 <    5');
print $constraints;
foreach ($constraints as $constraint) {
  print   $constraints->getPrettyString();
}
