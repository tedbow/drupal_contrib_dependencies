<?php

namespace DrupalContribDependencies\FromDrupal;


/**
 * A value object representing dependency information.
 */
class Dependency  {

  /**
   * The name of the dependency.
   *
   * @var string
   */
  protected $name;

  /**
   * The project namespace for the dependency.
   *
   * @var string
   */
  protected $project;

  /**
   * The constraint string.
   */
  protected $constraintString;

  /**
  /**
   * Dependency constructor.
   *
   * @param string $name
   *   The name of the dependency.
   * @param string $project
   *   The project namespace for the dependency.
   * @param string $constraint
   *   The constraint string. For example, '>8.x-1.1'.
   */
  public function __construct($name, $project, $constraint) {
    $this->name = $name;
    $this->project = $project;
    $this->constraintString = $constraint;
  }

  /**
   * Gets the dependency's name.
   *
   * @return string
   *   The dependency's name.
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Gets the dependency's project namespace.
   *
   * @return string
   *   The dependency's project namespace.
   */
  public function getProject() {
    return $this->project;
  }

  /**
   * Gets constraint string from the dependency.
   *
   * @return string
   *   The constraint string.
   */
  public function getConstraintString() {
    return $this->constraintString;
  }
  /**
   * Creates a new instance of this class from a dependency string.
   *
   * @param string $dependency
   *   A dependency string, which specifies a module or theme dependency, and
   *   optionally the project it comes from and a constraint string that
   *   determines the versions that are supported. Supported formats include:
   *   - 'module'
   *   - 'project:module'
   *   - 'project:module (>=version, <=version)'.
   *
   * @return static
   */
  public static function createFromString($dependency) {
    if (strpos($dependency, ':') !== FALSE) {
      list($project, $dependency) = explode(':', $dependency);
    }
    else {
      $project = '';
    }
    $parts = explode('(', $dependency, 2);
    $name = trim($parts[0]);
    $version_string = isset($parts[1]) ? rtrim($parts[1], ") ") : '';
    return new static($name, $project, $version_string);
  }

  /**
   * Prevents unnecessary serialization of constraint objects.
   *
   * @return array
   *   The properties to seriailize.
   */
  public function __sleep() {
    return ['name', 'project', 'constraintString'];
  }

}
