<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfDoctrineGuardPlugin configuration.
 * 
 * @package    sfSAMLPlugin
 * @subpackage config
 * @author     Théophile Helleboid <t.helleboid@iariss.fr>
 * @version    SVN: $Id: sfDoctrineGuardPluginConfiguration.class.php 25546 2009-12-17 23:27:55Z Jonathan.Wage $
 */
class sfSAMLPluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    if (in_array('sfSAMLAuth', sfConfig::get('sf_enabled_modules', array())))
    {
      $this->dispatcher->connect('routing.load_configuration', array('sfSAMLRouting', 'listenToRoutingLoadConfigurationEvent'));
    }

  }
}
