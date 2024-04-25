<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>

<?php if ($this->params->get('show_page_heading')) : ?>
    <div class="relative z-10 w-full px-2 xl:px-8 lg:py-4 bg-light-taupe">
        <div class="page-header flex flex-wrap items-center gap-0 inner-space-title lg:gap-3">
            <?php echo ((isset($pageHeading)) ? $pageHeading : $this->escape($this->menu->getActive()->title)); ?>
        </div>
    </div>
<?php endif; ?>
<div class="w-full">
    <p class="p-4 px-5 my-2 intro lg:p-8 lg:px-10">
      Here you will find videos of past events so you can catch up on what’ s
      been happening and hear what our speakers have been sharing in their
      classes and talks.
    </p>
  </div>
	<?php foreach ($this->items as $id => $item) :
		$slug = preg_replace('/[^a-z\d]/i', '-', $item->title);
		$slug = strtolower(str_replace(' ', '-', $slug));
	?>
	<div class="transition-all duration-300 audio-container virtue-shadow">
        <div><img src="<?php echo Uri::root() . $this->escape($item->thumbnail); ?>" alt="<?php echo $item->title; ?>" class="object-cover w-full lg:h-[15rem] aspect-video rounded-15px animation-hover"></div>
		<div class="flex flex-col justify-between w-full col-span-4 lg:px-6">
            <h1 class="audio-title"><?php echo $item->title; ?></h1>
            <section><p class="audio-paragraph"><?php echo $item->description; ?></p></section>
            <div class="flex items-center justify-between w-full py-4">
                <audio controls="" class="w-full">
                    <source src="<?php echo Uri::root() . $this->escape($item->audio_file); ?>">
                    Your browser does not support the audio element.
                </audio>
            </div>
        </div>
    </div>
	<?php endforeach; ?>
    
