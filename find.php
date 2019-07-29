<?php

use DrupalContribDependencies\DrupalOrgModuleList;
use DrupalContribDependencies\ModuleInfo;

require_once __DIR__ . '/vendor/autoload.php';
foreach (DrupalOrgModuleList::getMachineNames() as $machineName) {
  $module = new ModuleInfo($machineName);
  $module->downloadInfoFile();
}
