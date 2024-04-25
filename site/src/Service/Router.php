<?php

namespace BKWSU\Component\Audiofiles\Site\Service;

defined('_JEXEC') or die;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\RouterViewConfiguration;
use Joomla\CMS\Component\Router\Rules\MenuRules;
//use Joomla\CMS\Component\Router\Rules\NomenuRules;
//use J4xdemos\Component\Mywalks\Site\Service\MywalksNomenuRules as NomenuRules;
use Joomla\CMS\Component\Router\Rules\StandardRules;
use Joomla\CMS\Menu\AbstractMenu;
use Joomla\Database\DatabaseInterface;

class Router extends RouterView
{
	protected $noIDs = false;

	private $categoryFactory;

	private $db;

	public function __construct(SiteApplication $app, AbstractMenu $menu,
			CategoryFactoryInterface $categoryFactory, DatabaseInterface $db)
	{
		$this->categoryFactory = $categoryFactory;
		$this->db              = $db;

		$params = ComponentHelper::getParams('com_audiofiles');
		$this->noIDs = (bool) $params->get('sef_ids');

		$audiofiles = new RouterViewConfiguration('audiofiles');
		$audiofiles->setKey('id');
		$this->registerView($audiofiles);

		parent::__construct($app, $menu);

		$this->attachRule(new MenuRules($this));
		$this->attachRule(new StandardRules($this));
		//$this->attachRule(new NomenuRules($this));
	}
}
