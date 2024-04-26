<?php

namespace BKWSU\Component\Audiofiles\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Database\ParameterType;
use Joomla\CMS\Log\Log;

class AudiofilesModel extends ListModel
{
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'title', 'a.title',
				'distance', 'a.distance',
			);
		}

		parent::__construct($config);
	}

	protected function populateState($ordering = 'a.id', $direction = 'ASC')
	{
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		// List state information.
		parent::populateState($ordering, $direction);
	}

	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');

		return parent::getStoreId($id);
	}

	protected function getListQuery()
	{
		Log::add('Entered getListQuery', Log::DEBUG);
		// Create a new query object.
		$db    = $this->getDatabase();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.*'));
		$query->from($db->quoteName('#__audiofiles') . ' AS a');

		// Filter by search in title.
		$search = $this->getState('filter.search');

		Log::add('Entered getListQuery - search param: ' . trim($search), Log::DEBUG);

		if (!empty($search))
		{
			$search = '%' . $db->escape(trim($search)) . '%';
			//$query->where($db->quoteName('a.title') . ' LIKE :search')->bind(':search', $search, ParameterType::STRING);
			$query->where($db->quoteName('a.title') . " LIKE '" . $search . "'");
		}

		// Add the list ordering clause.
		$orderCol  = $this->state->get('list.ordering', 'a.id');
		$orderDirn = $this->state->get('list.direction', 'ASC');

		if ($orderCol === 'title') {
            $ordering = [
                $db->quoteName('a.title') . ' ' . $db->escape($orderDirn),
            ];
        } else {
            $ordering = $db->escape($orderCol) . ' ' . $db->escape($orderDirn);
        }

        $query->order($ordering);
		Log::add('Entered getListQuery - query: ' . $query->__toString(), Log::DEBUG);
		
		return $query;
	}
}
