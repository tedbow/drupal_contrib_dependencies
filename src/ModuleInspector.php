<?php

namespace DrupalContribDependencies;

class ModuleInspector {

  /**
   * @var string
   */
  private $moduleName;


  /**
   * ModuleInspector constructor.
   *
   * @param string $moduleName;
   */
  public function __construct($moduleName) {
    $this->moduleName = $moduleName;
  }

  public function output() {
    return "name = " . $this->moduleName;
  }
}
