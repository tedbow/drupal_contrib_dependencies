<?php

namespace DrupalContribDependencies;

use Composer\Semver\Semver;
use DrupalContribDependencies\Helpers\Exec;

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

  public function downloadInfoFile() {
    $this->initRepo();
    $branch = $this->getLatestMajorBranch('8');
    if ($branch) {
      exec("git checkout origin/$branch -- $this->machineName.info.yml");;

    }
  }

  public function getGitURl() {
    return "git@git.drupal.org:project/{$this->machineName}.git";
  }

  /**
   * @param $major
   */
  private function getLatestMajorBranch($major) {
    $latest_branch = '';
    $major_prefix = "$major.x-";
    $branches = Exec::execute('git branch -r');
    foreach ($branches as $branch) {
      $branch = str_replace('origin/', '', trim($branch));

      if (substr($branch, '0', 4) === $major_prefix) {
        $semantic = str_replace($major_prefix, '', $branch);
        if (empty($latest_branch) || 1 ||  Semver::satisfies($latest_branch, "< $semantic")) {
          $latest_branch = $semantic;
        }
      }
    }
    return $latest_branch ? "$major_prefix$latest_branch" : '';
  }

  private function initRepo() {
    chdir(dirname(get_included_files()[0]));
    $subdir = "downloaded/" . $this->machineName;
//    if (file_exists($subdir)) {
//      exec("rm -rf $subdir");
//    }

    if (!file_exists($subdir)) {
      exec("mkdir -p " . $subdir);
      chdir($subdir);
      exec('git init');
      exec("git remote add origin git@git.drupal.org:project/{$this->machineName}.git");
      exec('git fetch --depth=1 origin');
    }


  }
}
