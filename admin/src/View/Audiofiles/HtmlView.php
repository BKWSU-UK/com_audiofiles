<?php

namespace BKWSU\Component\Audiofiles\Administrator\View\Audiofiles;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;

class HtmlView extends BaseHtmlView
{
    protected $items;

    public function display($tpl = null)
    {
        Log::add('Entered HtmlView');
        $this->items = $this->get('Items');
        $this->state = $this->get('State');
		$this->pagination = $this->get('Pagination');

        //ToolBarHelper::preferences('com_audiofiles');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new GenericDataException(implode("\n", $errors), 500);
        }

        $this->addToolbar();

        return parent::display($tpl);
    }

    protected function addToolbar()
    {
        $toolbar = Toolbar::getInstance('toolbar');

        ToolbarHelper::title(Text::_('COM_AUDIOFILES_AUDIOFILES_PAGE_TITLE'), 'audiofiles');

        $canDo = ContentHelper::getActions('com_audiofiles');

        if ($canDo->get('core.create')) {
            $toolbar->addNew('audiofiles.add');
        }

        if ($canDo->get('core.edit.state'))
		{
			$dropdown = $toolbar->dropdownButton('status-group')
				->text('JTOOLBAR_CHANGE_STATUS')
				->toggleSplit(false)
				->icon('icon-ellipsis-h')
				->buttonClass('btn btn-action')
				->listCheck(true);

			$childBar = $dropdown->getChildToolbar();
			$childBar->publish('audiofiles.publish')->listCheck(true);
			$childBar->unpublish('audiofiles.unpublish')->listCheck(true);
			$childBar->archive('audiofiles.archive')->listCheck(true);

			if ($this->state->get('filter.published') != -2)
			{
				$childBar->trash('audiofiles.trash')->listCheck(true);
			}
		}

		if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete'))
		{
			$toolbar->delete('audiofiles.delete')
				->text('JTOOLBAR_EMPTY_TRASH')
				->message('JGLOBAL_CONFIRM_DELETE')
				->listCheck(true);
		}

		if ($canDo->get('core.create'))
		{
			$toolbar->preferences('com_audiofiles');
		}
    }
}
