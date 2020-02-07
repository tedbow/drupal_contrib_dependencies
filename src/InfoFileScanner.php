<?php

namespace DrupalContribDependencies;

use Composer\Semver\Semver;
use Composer\Semver\VersionParser;
use DrupalContribDependencies\FromDrupal\Dependency;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class InfoFileScanner {

  public static function scan($remove_prefix = TRUE) {
    $dir = dirname(get_included_files()[0]) . "/info_files/downloaded";
    $info_files = static::getDirContents($dir);
    $total_dependencies = 0;
    $bad_contrib_dependencies = [];
    $bad_core_dependencies = [];
    $parser = new VersionParser();
    $module_cnt = 0;
    $module_with_depencies = 0;
    foreach ($info_files as $info_file) {
      $module_cnt++;
      try {
        $info = Yaml::parseFile($info_file);
      }
      catch (ParseException $parseException) {
        continue;
      }
      $module_name = str_replace('.info.yml', '', basename($info_file));


      if (isset($info['core']) && !preg_match("/^\d\.x$/", $info['core'])) {
        $bad_core_dependencies[$module_name] = $info['core'];
      }
      continue;
      if (!empty($info['dependencies']) && is_array($info['dependencies'])) {
        $total_dependencies += count($info['dependencies']);
        $module_with_depencies++;

        foreach ($info['dependencies'] as $dependency_string) {
          $dependency = Dependency::createFromString($dependency_string);
          if ($constraint_string = $dependency->getConstraintString()) {
            if ($remove_prefix) {
              $constraint_string = str_replace('8.x-', '', $constraint_string);
            }

            try {
              $parser->parseConstraints($constraint_string);
            }
            catch (\UnexpectedValueException $exception) {
              $bad = "$module_name," . $dependency_string;
              if ($dependency->getProject() === 'drupal' ||  $dependency->getName() === 'system') {
                $bad_core_dependencies[] = $bad;

              }
              else {
                $bad_contrib_dependencies[] = $bad;
              }
            }
          }
        }
      }
    }
    return [
      'bad_contrib' => $bad_contrib_dependencies,
      'bad_core' => $bad_core_dependencies,
      'total_dependencies' => $total_dependencies,
      'module_with_dependencies' => $module_with_depencies,
      'moodules' => $module_cnt,
    ];
  }
  public static function getDirContents($dir){
    $results = [];
    $files = scandir($dir);

    foreach ($files as $key => $value) {
      $path = realpath($dir . DIRECTORY_SEPARATOR . $value);

      if (is_dir($path) && $value != "." && $value != "..") {
         $results = array_merge($results, static::getDirContents($path));
      }
      elseif (strstr($path,   '.info.yml') !== FALSE) {
        $results[] = $path;
      }
    }

    return $results;
  }

}
