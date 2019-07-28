<?php

namespace DrupalContribDependencies;

class DrupalOrgModuleList {

  /**
   * @return string[]
   */
  public static function getMachineNames() {
    $file = fopen("modulelistmachinenames.csv","r");
    $machine_names = [];
    while ($module_info = fgetcsv($file)) {
      $machine_name = $module_info[0];
      if ($machine_name === 'drupal') {
        continue;
      }
      $machine_names[] = $machine_name;
    }
    fclose($file);
    return $machine_names;
  }
}
