README
================================
sfSAMLPlugin is a symfony plugin that allow you to interface SAML with sfDoctrineGuardPlugin.

sfSAMLPlugin uses simpleSAMLPhp ( http://simplesamlphp.org/ ) for dealing with the Identity Provider (IdP).
With sfSAMLPlugin, you symfony application is a Service Provider (SP).


Installation
================================

If you want to install sfSAMLPlugin, follow these steps :

1. Télécharger le plugin sfSAMLPlugin et le décompresser dans le dossier plugins/ de symfony
2. Installer le plugin sfDoctrineGuardPlugin : http://www.symfony-project.org/plugins/sfDoctrineGuardPlugin
3. Télécharger SimpleSAMLPhp : http://simplesamlphp.org/download
4. Décompresser SimpleSAMLPhp dans le dossier /lib/vendor/
5. Ajouter les lignes suivantes dans config/ProjectConfiguration.php de symfony :
    $this->enablePlugins('sfSAMLPlugin');
    // Load simpleSAMLphp
    require_once dirname(__FILE__).'/../lib/vendor/simplesamlphp/lib/_autoload.php';
Attention : la 3ème ligne doit être configurée avec le chemin de simplesamlphp
7. 


