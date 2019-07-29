# Drupal Contrib Dependencies Scanner

## About
This projects checks out all topl level info.yml files from Drupal contrib projects to determing if they dependency constraints are compatible with composer.

modulelistmachinenames.csv was copied from https://github.com/mcdwayne/d9-drupal-check-allthemodules/blob/master/modulelistmachinenames.csv

`getInfoFiles.php` does not need to be run unless the info files need to be updated.

## How to use
1. `composer install`
2. `php infoScan.php` 
