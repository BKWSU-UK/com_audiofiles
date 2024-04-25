<?php
namespace BKWSU\Component\Audiofiles\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Session\Session;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;

class AudiofileController extends FormController
{
    // /**
    //  * Method to add a new record. Overrides the add method from FormController.
    //  */
    // public function add()
    // {
    //     if (!$this->allowAdd()) {
    //         $this->setMessage(Text::_('JLIB_APPLICATION_ERROR_CREATE_RECORD_NOT_PERMITTED'), 'error');
    //         $this->setRedirect(Route::_('index.php?option=com_audiofiles&view=audiofiles', false));
    //         return false;
    //     }

    //     return parent::add();
    // }

    // /**
    //  * Method to edit an existing record. Overrides the edit method from FormController.
    //  *
    //  * @param string $key The name of the primary key of the URL variable.
    //  * @param string $urlVar The name of the URL variable if different from the primary key.
    //  */
    // public function edit($key = null, $urlVar = null)
    // {
    //     $key = $key ?: 'id';
    //     $urlVar = $urlVar ?: 'id';

    //     if (!$this->allowEdit(array($key => $this->input->getInt($key)), $key)) {
    //         $this->setMessage(Text::_('JLIB_APPLICATION_ERROR_EDIT_NOT_PERMITTED'), 'error');
    //         $this->setRedirect(Route::_('index.php?option=com_audiofiles&view=audiofiles', false));
    //         return false;
    //     }

    //     return parent::edit($key, $urlVar);
    // }

    // /**
    //  * Method to delete one or more records.
    //  */
    // public function delete()
    // {
    //     Session::checkToken() or jexit(Text::_('JINVALID_TOKEN'));

    //     $ids = $this->input->get('cid', array(), 'array');
    //     $model = $this->getModel('Audiofile');

    //     if ($model->delete($ids)) {
    //         $this->setMessage(Text::plural('COM_AUDIOFILES_N_ITEMS_DELETED', count($ids)));
    //     } else {
    //         $this->setMessage($model->getError(), 'error');
    //     }

    //     $this->setRedirect(Route::_('index.php?option=com_audiofiles&view=audiofiles', false));
    // }
}
