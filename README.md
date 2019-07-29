# Drupal Contrib Dependencies Scanner

## About
This projects checks out all *top level*(no submodules) info.yml files from Drupal contrib projects to determing if they dependency constraints are compatible with composer. 

It remove the `8.x-` prefix if used and then test constraint against `\Composer\Semver\VersionParser::parseConstraints()`

modulelistmachinenames.csv was copied from https://github.com/mcdwayne/d9-drupal-check-allthemodules/blob/master/modulelistmachinenames.csv
## Results
Out of 6380 modules scanned there were only 43 invalid constraints for other contrib modules and 27 invalid constraints for contrib modules.

The results of a scan on 7/29/2019 are in [`results.txt`](results.txt)

## How to use
1. `composer install`
2. `php infoScan.php` 

`getInfoFiles.php` does not need to be run unless the info files need to be updated.

#Related Drupal.org issues
[[META] Improve dependency management](https://www.drupal.org/project/drupal/issues/3069795)

[Module version dependency in .info.yml is ineffective for patch releases](https://www.drupal.org/project/drupal/issues/2641658)
