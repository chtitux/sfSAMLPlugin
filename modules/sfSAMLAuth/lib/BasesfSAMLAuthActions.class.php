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
class BasesfSAMLAuthActions extends sfActions
{
  public function executeSignin($request)
  {
    $user = $this->getUser();
    if ($user->isAuthenticated())
    {
      return $this->redirect('@homepage');
    }


    // Create SimpleSAML module
    $simpleSAMLAuth = new SimpleSAML_Auth_Simple('default-sp');
    
    // If the user is authenticated from the IdP
    if ($simpleSAMLAuth->isAuthenticated())
    {
      $attributes = $simpleSAMLAuth->getAttributes();

      // save the referer
      $user_referer = $user->getReferer($request->getReferer());

      // Try to find the user with his uid
      $query = Doctrine_Core::getTable('sfGuardUser')->createQuery('u')
        ->where('u.username = ?', $attributes['uid'][0]);

      // If the sGuardUser already exists in the database, it's OK
      if($query->count() >= 1)
      {
        $guard_user = $query->fetchOne();
      }
      else
      {
        // the user doesn't exist, we create a new one with random password
        $guard_user = new sfGuardUser();
        $guard_user->setUsername($attributes['uid'][0]);
        $guard_user->setPassword(md5(microtime().$attributes['uid'][0]. mt_rand ()));
        $guard_user->setEmailAddress($attributes['mail'][0]);
        $guard_user->setIsActive(true);
        $guard_user->save();
      }

      // Let the User signin
      // The auth is not rembered : the IdP can decide that
      $this->getUser()->signin($guard_user, $remember = false);

      // always redirect to a URL set in app.yml
      // or to the referer
      // or to the homepage
      $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user_referer /*$user->getReferer($request->getReferer())*/ );

      return $this->redirect('' != $signinUrl ? $signinUrl : '@homepage');
    }
    else  // the user is not authenticated in symfony and from the IdP
    {
      if ($request->isXmlHttpRequest())
      {
        $this->getResponse()->setHeaderOnly(true);
        $this->getResponse()->setStatusCode(401);

        return sfView::NONE;
      }

      // if we have been forwarded, then the referer is the current URL
      // if not, this is the referer of the current request
      $user->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $request->getUri() : $request->getReferer());

      $this->url_idp = $simpleSAMLAuth->login(array(
        'saml:idp' => 'https://openidp.feide.no',
      ));

      // Nothing happened after there, $simpleSAMLAuth->login() calls exit()

/*
      $module = sfConfig::get('sf_login_module');
      if ($this->getModuleName() != $module)
      {
        return $this->redirect($module.'/'.sfConfig::get('sf_login_action'));
      }

      $this->getResponse()->setStatusCode(401);
*/
    }
  }

  public function executeSignout($request)
  {
    $this->getUser()->signOut();

    $signoutUrl = sfConfig::get('app_sf_guard_plugin_success_signout_url');

    $simpleSAMLAuth = new SimpleSAML_Auth_Simple('default-sp');
    $simpleSAMLAuth->logout($this->generateUrl('' != $signoutUrl ? $signoutUrl : 'homepage'), array(), true);
    // Nothing happen after there
    

    $this->redirect('' != $signoutUrl ? $signoutUrl : 'homepage');
  }

  public function executeSecure($request)
  {
    $this->getResponse()->setStatusCode(403);
  }

  public function executePassword($request)
  {
    throw new sfException('This method is not yet implemented.');
  }
}
