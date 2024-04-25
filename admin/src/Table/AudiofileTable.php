<?php
namespace BKWSU\Component\Audiofiles\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;
use Joomla\CMS\Log\Log;

class AudiofileTable extends Table
{

    /**
     * Constructor
     *
     * @param DatabaseDriver $db A database connector object
     */
    public function __construct(DatabaseDriver $db)
    {
        Log::add('Entered AudiofileTable');
        parent::__construct('#__audiofiles', 'id', $db);
    }

}
