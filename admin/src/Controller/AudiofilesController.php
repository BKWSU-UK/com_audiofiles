<?php

namespace BKWSU\Component\Audiofiles\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Factory;

/**
 * Mywalks list controller class.
 *
 * @since  1.6
 */
class AudiofilesController extends AdminController
{
	public function getModel($name = 'Audiofile', $prefix = 'Administrator', $config = array('ignore_request' => true))
	{
		Log::add('Entered AudiofilesController');
		//app = Factory::getApplication();
		//$model = $app->bootComponent('com_plugins')->getMVCFactory()->createModel('Plugin', 'Administrator', ['ignore_request' => true]);
		
		return parent::getModel($name, $prefix, $config);
	}
}