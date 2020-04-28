<?php

namespace Drush\Commands\drush_blackfire\Commands;

use Blackfire\Client;
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
   * @var \Blackfire\Client
   */
  protected static $blackfire;

  /**
   * @var \Blackfire\Probe
   */
  protected static $probe;

  /**
   * @hook option *
   *
   * @option bf Profile with blackfire.
   */
  public function optionsetBlackfire($options = ['bf' => FALSE]) {
  }

  /**
   * Enable profiling via blackfire.
   *
   * @hook init *
   */
  public function blackfireInitialize(InputInterface $input, AnnotationData $annotationData) {
    if ($input->hasOption('bf') && $input->getOption('bf') && class_exists(Client::class)) {
      $this->logger()->debug('Starting blackfire probe...');
      static::$blackfire = new Client();
      static::$probe = static::$blackfire->createProbe();
    }
  }

  /**
   * Finish profiling via blackfire.
   *
   * @hook post-command *
   */
  public function blackfirePost($result, CommandData $commandData) {
    if (isset(static::$probe)) {
      $this->logger()->debug('Finalizing blackfire probe...');
      $profile = static::$blackfire->endProbe(static::$probe);
      $this->logger()->notice(dt('Blackfire profile saved. !url', [
        '!url' => $profile->getUrl(),
      ]));
    }
  }

}
