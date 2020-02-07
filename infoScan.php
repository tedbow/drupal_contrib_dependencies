<?php
/**
 * Scans all downloaded info files and returns results.
 */

use Composer\Semver\Semver;
use Composer\Semver\VersionParser;
use DrupalContribDependencies\InfoFileScanner;

require_once __DIR__ . '/vendor/autoload.php';

 print_r(Semver::rsort(['1','1.1']));
 print_r(Semver::rsort(['1.1', '1']));
 exit;
print "helelelel";
print_r(explode('.', '8.x-1.x',-1));
return;
print_r((string)(new VersionParser())->parseConstraints('8.x'));
// print_r((string)(new VersionParser())->parseConstraints('1.2.*'));
exit;
$results = InfoFileScanner::scan();
print_r($results);
