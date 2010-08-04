<?php

/*
 * This file is part of the sfSAMLplugin package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) 2010      Théophile Helleboid <t.helleboid@iariss.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardRouting.class.php 25546 2009-12-17 23:27:55Z Jonathan.Wage $
 */
class sfSAMLRouting
{
  /**
   * Listens to the routing.load_configuration event.
   *
   * @param sfEvent An sfEvent instance
   * @static
   */
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $r = $event->getSubject();

    // preprend our routes
    $r->prependRoute('sf_saml_signin', new sfRoute('/saml/login', array('module' => 'sfSAMLAuth', 'action' => 'signin'))); 
    $r->prependRoute('sf_saml_signout', new sfRoute('/saml/logout', array('module' => 'sfSAMLAuth', 'action' => 'signout'))); 
  }


}