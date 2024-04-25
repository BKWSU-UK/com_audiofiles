<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;

//HTMLHelper::_('behavior.multiselect');
// $user      = Factory::getUser();
// $userId    = $user->get('id');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));

?>
<form action="<?php echo Route::_('index.php?option=com_audiofiles'); ?>" method="post" name="adminForm" id="adminForm">
<?php echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
	<?php if (empty($this->items)) : ?>
		<div class="alert alert-info">
			<span class="fa fa-info-circle" aria-hidden="true"></span><span class="sr-only"><?php echo Text::_('INFO'); ?></span>
			<?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
		</div>
	<?php else : ?>
        <table class="table table-striped" id="audiofilesList">
            <thead>
                <tr>
                    <th width="1%" class="nowrap center hidden-phone">
                        <?php echo HTMLHelper::_('grid.checkall'); ?>
                    </th>
                    <th>
                        <?php echo HTMLHelper::_('grid.sort', 'COM_AUDIOFILES_HEADING_TITLE', 'title', $listDirn, $listOrder); ?>
                    </th>
                    <th width="20%">
                        <?php echo Text::_('COM_AUDIOFILES_HEADING_ARTIST'); ?>
                    </th>
                    <th width="10%">
                        <?php echo Text::_('COM_AUDIOFILES_HEADING_CATEGORY'); ?>
                    </th>
                    <th width="10%">
                        <?php echo Text::_('COM_AUDIOFILES_HEADING_THUMBNAIL'); ?>
                    </th>
                    <th width="10%">
                        <?php echo Text::_('COM_AUDIOFILES_HEADING_AUDIO_FILE'); ?>
                    </th>
                </tr>
            </thead>
            <tbody>
            
            <?php if (isset($this->items)) { ?>
                <?php //var_dump($this->items); ?>
            <?php foreach ($this->items as $i => $item) : ?>
                <tr class="row<?php echo $i % 2; ?>">
                    <td class="center hidden-phone">
                        <?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
                    </td>
                    <td>
                        <a class="hasTooltip" href="<?php echo Route::_('index.php?option=com_audiofiles&task=audiofile.edit&id=' . $item->id); ?>">
                        <span class="fa fa-pen-square me-2" aria-hidden="true"></span><?php echo $this->escape($item->title); ?>
						</a>
                    </td>
                    <td>
                        <?php echo $this->escape($item->artist_speaker); ?>
                    </td>
                    <td>
                        <?php echo $this->escape($item->category); ?>
                    </td>
                    <td>
                        <img src="<?php echo Uri::root() . $this->escape($item->thumbnail); ?>" alt="<?php echo Text::_('COM_AUDIOFILES_THUMBNAIL_ALT'); ?>" style="width:100px;">
                    </td>
                    <td>
                    <audio src="<?php echo Uri::root() . $this->escape($item->audio_file); ?>" controls preload="none"></audio>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php } ?>
            </tbody>
        </table>
        <?php //echo HTMLHelper::_('pagination', $this->pagination, Route::_('index.php?option=com_audiofiles&view=audiofiles')); ?>
        <?php echo $this->pagination->getListFooter(); ?>
    <?php endif;?>
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <!--input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
    <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" /-->
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
