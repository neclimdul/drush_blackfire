<?php

namespace Drupal\drush_blackfire\Commands;

use Consolidation\AnnotatedCommand\AnnotationData;
use Consolidation\AnnotatedCommand\CommandData;
use Drush\Commands\DrushCommands;
use Symfony\Component\Console\Input\InputInterface;

/**
 * A Drush commandfile.
 *
 * In addition to this file, you need a drush.services.yml
 * in root of your module, and a composer.json file that provides the name
 * of the services file to use.
 *
 * See these files for an example of injecting Drupal services:
 *   - http://cgit.drupalcode.org/devel/tree/src/Commands/DevelCommands.php
 *   - http://cgit.drupalcode.org/devel/tree/drush.services.yml
 */
class DrushBlackfireCommands extends DrushCommands {

  /**
   * @hook option *
   *
   * @option bf Profile with blackfire.
   */
  public function optionsetBlackfire($options = ['bf' => self::REQ]) {
    echo 'option...';
  }

  /**
   * Enable profiling via XHProf
   *
   * @hook post-command *
   */
  public function blackfirePost($result, CommandData $commandData) {
    if (self::blackfireEnabled()) {
      echo 'finish';
    }
  }

  /**
   * Enable profiling via blackfire.
   *
   * @hook init *
   */
  public function blackfireInitialize(InputInterface $input, AnnotationData $annotationData) {
    echo 'starting';
  }


  public static function blackfireEnabled() {
    return true;
  }

}
