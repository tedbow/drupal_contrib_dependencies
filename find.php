<?php

use DrupalContribDependencies\DrupalOrgModuleList;
use DrupalContribDependencies\Helpers\Test;
use DrupalContribDependencies\ModuleInfo;
use DrupalContribDependencies\ModuleInspector;

require_once __DIR__ . '/vendor/autoload.php';
$count = 0;
foreach (DrupalOrgModuleList::getMachineNames() as $machineName) {
  $module = new ModuleInfo($machineName);
  $module->downloadInfoFile();
  if (++$count == 2) {
    //exit();
  }
}
