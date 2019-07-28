<?php

namespace DrupalContribDependencies;

class ModuleInfo {

  /**
   * @var string
   */
  protected $machineName;


  /**
   * ModuleInfo constructor.
   */
  public function __construct($machine_name) {
    $this->machineName = $machine_name;
  }

  public function getDependencies() {
    new \Git();
  }
}
