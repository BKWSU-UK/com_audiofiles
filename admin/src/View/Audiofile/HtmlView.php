<?php

namespace BKWSU\Component\Audiofiles\Administrator\View\Audiofile;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;

/**
 * View to edit an article.
 *
 * @since  1.6
 */
class HtmlView extends BaseHtmlView
{
	public function display($tpl = null)
	{
		$this->form  = $this->get('Form');
		$this->item  = $this->get('Item');
		$this->state = $this->get('State');

		if (count($errors = $this->get('Errors')))
		{
			throw new GenericDataException(implode("\n", $errors), 500);
		}

		$this->addToolbar();

		return parent::display($tpl);
	}

	protected function addToolbar()
	{
		Factory::getApplication()->input->set('hidemainmenu', true);
		$isNew      = ($this->item->id == 0);

		$toolbar = Toolbar::getInstance();

		ToolbarHelper::title(
			Text::_('COM_AUDIOFILES_AUDIOFILE_PAGE_TITLE_' . ($isNew ? 'ADD_FILE' : 'EDIT_FILE'))
		);

		$canDo = ContentHelper::getActions('com_audiofiles');
		if ($canDo->get('core.create'))
		{
			$toolbar->apply('audiofile.apply');
			$toolbar->save('audiofile.save');
		}
		if ($isNew)
		{
			$toolbar->cancel('audiofile.cancel', 'JTOOLBAR_CANCEL');
		}
		else
		{
			$toolbar->cancel('audiofile.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}