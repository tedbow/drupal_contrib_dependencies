<?php

namespace DrupalContribDependencies\Helpers;

class Exec {

  public static function execute($cmd) {
    exec($cmd, $output);
    return $output;
  }
}
