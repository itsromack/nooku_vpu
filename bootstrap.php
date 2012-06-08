<?php
if (!defined('DOCROOT')) define("DOCROOT", getenv("DOCUMENT_ROOT")) ;

// Set flag that this is a parent file.
define('_JEXEC', 1);
define('DS', DIRECTORY_SEPARATOR);

define('JPATH_BASE', DOCROOT . '/PATH/TO/JOOMLA!');

//Global definitions.
//Joomla framework path definitions.
$parts = explode(DIRECTORY_SEPARATOR, JPATH_BASE);

//Defines.
if (!defined('JPATH_CONFIGURATION'))     define('JPATH_CONFIGURATION',  JPATH_BASE);
if (!defined('JPATH_ROOT'))              define('JPATH_ROOT',           implode(DIRECTORY_SEPARATOR, $parts));
if (!defined('JPATH_SITE'))              define('JPATH_SITE',           JPATH_ROOT);
if (!defined('JPATH_ADMINISTRATOR'))     define('JPATH_ADMINISTRATOR',	JPATH_ROOT . '/administrator');
if (!defined('JPATH_LIBRARIES'))         define('JPATH_LIBRARIES',		JPATH_ROOT . '/libraries');
if (!defined('JPATH_PLUGINS'))           define('JPATH_PLUGINS',		JPATH_ROOT . '/plugins'  );
if (!defined('JPATH_INSTALLATION'))      define('JPATH_INSTALLATION',	JPATH_ROOT . '/installation');
if (!defined('JPATH_THEMES'))            define('JPATH_THEMES',			JPATH_BASE . '/templates');
if (!defined('JPATH_CACHE'))             define('JPATH_CACHE',			JPATH_BASE . '/cache');
if (!defined('JPATH_MANIFESTS'))         define('JPATH_MANIFESTS',		JPATH_ADMINISTRATOR . '/manifests');

require_once JPATH_BASE.'/includes/framework.php';

// Koowa
if (!defined('JPATH_KOOWA'))             define( 'JPATH_KOOWA',         JPATH_PLUGINS .'/koowa');

// Instantiate the application.
$app = JFactory::getApplication('site');
// Initialise the application.
$app->initialise();
// Route the application.
$app->route();

# Taken from Koowa's __construct()r
# Load Koowa
$config = new KConfig();
$loader = KLoader::getInstance($config);

//Setup the factory
$service = KService::getInstance($config);
$service->set('koowa:loader', $loader);

// Check if Koowa is active
if(!defined('KOOWA')) {
    JError::raiseWarning(0, JText::_("Koowa wasn't found. Please install the Koowa plugin and enable it."));
    return;
}
