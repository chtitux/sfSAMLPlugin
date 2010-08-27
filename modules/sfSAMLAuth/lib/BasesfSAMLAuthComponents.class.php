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
 * sfSAMLPlugin configuration.
 * 
 * @package    sfSAMLPlugin
 * @subpackage sfSAMLAuth
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Théophile Helleboid <t.helleboid@iariss.fr>
 */
class BasesfSAMLAuthComponents extends sfComponents
{
  public function executeSignin_form()
  {
//    $class = sfConfig::get('app_sf_saml_plugin_signin_form', 'sfGuardFormSignin'); 
//    $this->form = new $class();
  }
}