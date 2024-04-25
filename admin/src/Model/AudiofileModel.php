<?php

namespace BKWSU\Component\Audiofiles\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;

class AudiofileModel extends AdminModel
{
    protected $text_prefix = 'COM_AUDIOFILES';

    public function getTable($name = 'audiofile', $prefix = 'Table', $config = array())
    {
        return parent::getTable($name, $prefix, $config);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_audiofiles.audiofile',
            'audiofile',
            array('control' => 'jform', 'load_data' => $loadData)
        );

        if (empty($form)) {
            return false;
        }
        return $form;
    }

    protected function loadFormData()
    {
        $app = Factory::getApplication();
        $data = $app->getUserState('com_audiofiles.edit.audiofile.data', array());

        if (empty($data)) {
            $data = $this->getItem();
        }

        $this->preprocessData('com_audiofiles.audiofile', $data);

        return $data;
    }

    protected function canEditState($record)
	{
		// Check for existing article.
		if (!empty($record->id))
		{
			return $this->getCurrentUser()->authorise('core.edit.state', 'com_audiofiles.audiofiles.' . (int) $record->id);
		}

		// Default to component settings if neither article nor category known.
		return parent::canEditState($record);
	}

    // protected function populateState($ordering = 'a.id', $direction = 'asc')
	// {
	// 	$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
	// 	$this->setState('filter.search', $search);

	// 	$published = $this->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
	// 	$this->setState('filter.published', $published);

	// 	// List state information.
	// 	parent::populateState($ordering, $direction);
	// }
}
