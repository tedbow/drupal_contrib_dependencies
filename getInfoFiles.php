<?php
/**
 * Only run this file if you need to get updated info.yml files.
 * info_files/downloaded contains info files downloaded 7/28/2019.
 */

use DrupalContribDependencies\DrupalOrgModuleList;
use DrupalContribDependencies\ModuleInfo;

require_once __DIR__ . '/vendor/autoload.php';
foreach (DrupalOrgModuleList::getMachineNames() as $machineName) {
  $module = new ModuleInfo($machineName);
  $module->downloadInfoFile();
}
