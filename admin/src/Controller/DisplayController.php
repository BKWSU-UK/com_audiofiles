<?php
namespace BKWSU\Component\Audiofiles\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Log\Log;

class DisplayController extends BaseController
{
    /**
     * The default view for the component.
     *
     * @var string
     */
    protected $default_view = 'audiofiles';

    /**
     * Method to display a view.
     *
     * @param   boolean  $cachable   If true, the view output will be cached.
     * @param   array    $urlparams  An array of safe URL parameters and their variable types.
     * @return  BaseController  This object to support chaining.
     */
    public function display($cachable = false, $urlparams = array())
    {
        Log::add('Entered DisplayController');

        // Call parent behavior
        return parent::display();
    }
}
