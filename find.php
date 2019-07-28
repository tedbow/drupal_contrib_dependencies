<?php

use DrupalContribDependencies\DrupalOrgModuleList;
use DrupalContribDependencies\Helpers\Test;
use DrupalContribDependencies\ModuleInspector;

require_once __DIR__ . '/vendor/autoload.php';


print_r(DrupalOrgModuleList::getMachineNames());
