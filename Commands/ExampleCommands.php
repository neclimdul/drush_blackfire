<?php

namespace Drush\Commands\drush_blackfire\Commands;

use Consolidation\AnnotatedCommand\CommandData;
use Drush\Commands\DrushCommands;
use Drush\Exceptions\UserAbortException;
use Symfony\Component\Console\Input\InputInterface;
use Consolidation\SiteAlias\SiteAliasManagerAwareInterface;
use Consolidation\SiteAlias\SiteAliasManagerAwareTrait;

/**
 * Edit this file to reflect your organization's needs.
 */
class ExampleCommands extends DrushCommands {

  /**
   * @command example:log
   *
   * Demonstrates the use of notices, warnings and debug messages
   * in commands.
   */
  public function exampleLog() {
    $this->logger()->notice('This is a notice');
    $this->logger()->warning('This is a warning');
    $this->logger()->debug('This is a debug message');
  }

}
