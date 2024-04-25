<?php

namespace BKWSU\Component\Audiofiles\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Database\ParameterType;

class AudiofilesModel extends ListModel
{

	protected function getListQuery()
	{
		// Create a new query object.
		$db    = $this->getDatabase();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.*, (SELECT count(' 
				. $db->quoteName('id') 
				. ') FROM ' . $db->quoteName('#__audiofiles') 
				. ' WHERE id = a.id) AS files'
			)
		);
		$query->from($db->quoteName('#__audiofiles') . ' AS a');

		return $query;
    }

    public function getItems()
	{
		$items = parent::getItems();

		return $items;
	}
}