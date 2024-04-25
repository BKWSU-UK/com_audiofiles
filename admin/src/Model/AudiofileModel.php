<?php

namespace BKWSU\Component\Audiofiles\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;

class AudiofileModel extends AdminModel
{
    protected $text_prefix = 'COM_AUDIOFILES';

    public function getTable($type = 'Audiofile', $prefix = 'AdministratorTable', $config = array())
    {
        return parent::getTable($type, $prefix, $config);
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
        $data = $app->getUserState(
            'com_audiofiles.edit.audiofile.data',
            array()
        );

        if (empty($data)) {
            $data = $this->getItem();
        }

        $this->preprocessData('com_audiofiles.audiofile', $data);

        return $data;
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
