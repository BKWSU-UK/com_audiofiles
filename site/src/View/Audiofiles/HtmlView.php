<?php

namespace BKWSU\Component\Audiofiles\Site\View\Audiofiles;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView
{
	public function display($tpl = null)
	{
		$app            = Factory::getApplication();
		$this->menu     = $app->getMenu();
		$this->input    = $app->input;
        $this->params   = $app->getParams();
		// Get data from the model.
		$this->state      = $this->get('State');
		$this->items      = $this->get('Items');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');
		$this->pagination = $this->get('Pagination');
		// Flag indicates to not add limitstart=0 to URL
		$this->pagination->hideEmptyLimitstart = true;

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new GenericDataException(implode("\n", $errors), 500);
		}

		return parent::display($tpl);
	}
}
