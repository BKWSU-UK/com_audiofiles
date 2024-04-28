<?php

defined('_JEXEC') or die;

use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Layout\LayoutHelper;

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));

$doc = Factory::getApplication()->getDocument();

$doc->addStyleDeclaration('
 /* The container must be positioned relative: */
 .custom-select {
  position: relative;
  font-family: \'Montserrat-Medium\';
  width:260px;
}

.custom-select select {
  display: none; /*hide original SELECT element: */
}

.select-selected {
  background-color: white;
}

/* Style the arrow inside the select element: */
.select-selected:after {
  --tw-text-opacity: 1;
  color: rgb(113 41 59 / var(--tw-text-opacity));
  position: absolute;
  content: "";
  top: 24px;
  right: 10px;
  width: 0;
  height: 0;
  border: 8px solid transparent;
  border-color: rgb(113 41 59) transparent transparent transparent;
}

/* Point the arrow upwards when the select box is open (active): */
.select-selected.select-arrow-active:after {
  border-color: transparent transparent rgb(113 41 59) transparent;
  top: 17px;
}

/* style the items (options), including the selected item: */
.select-items div,.select-selected {
  /*color: #ffffff;*/
  padding: 8px 16px;
  border: 1px solid transparent;
  border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
  cursor: pointer;
}

/* Style items (options): */
.select-items {
    margin-top: 24px;
  position: absolute;
  background-color: white;
  top: 100%;
  left: 0;
  right: 0;
  z-index: 99;
}

/* Hide the items when the select box is closed: */
.select-hide {
  display: none;
}

.select-items div:hover, .same-as-selected {
  background-color: rgba(0, 0, 0, 0.1);
} 
');

$doc->addScriptDeclaration('
  document.addEventListener("DOMContentLoaded", function() {
    const limit = 150;  // Limit of characters to show in the short version

    document.querySelectorAll(\'.text-block\').forEach(function(block) {
      var textElement = block.querySelector(\'.text\');
      var fullText = textElement.innerText;

      if (fullText.length > limit) {
        var shortText = fullText.substr(0, limit) + \'...\';
        textElement.innerText = shortText;
      } else {
        block.querySelector(\'.toggle-btn\').style.display = \'none\';  // Hide button if text is short
      }

      block.querySelector(\'.toggle-btn\').addEventListener(\'click\', function() {
        var btn = this;
        if (btn.innerText === \'Read more\') {
          textElement.innerText = fullText;
          btn.innerText = \'Read less\';
        } else {
          textElement.innerText = shortText;
          btn.innerText = \'Read more\';
        }
      });
    });


    var x, i, j, l, ll, selElmnt, a, b, c;
    /* Look for any elements with the class "custom-select": */
    x = document.getElementsByClassName("custom-select");
    l = x.length;
    for (i = 0; i < l; i++) {
      selElmnt = x[i].getElementsByTagName("select")[0];
      ll = selElmnt.length;
      /* For each element, create a new DIV that will act as the selected item: */
      a = document.createElement("DIV");
      a.setAttribute("class", "select-selected");
      a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
      x[i].appendChild(a);
      /* For each element, create a new DIV that will contain the option list: */
      b = document.createElement("DIV");
      b.setAttribute("class", "select-items select-hide virtue-shadow");
      for (j = 0; j < ll; j++) {
        /* For each option in the original select element,
        create a new DIV that will act as an option item: */
        c = document.createElement("DIV");
        c.innerHTML = selElmnt.options[j].innerHTML;
        c.addEventListener("click", function(e) {
            /* When an item is clicked, update the original select box,
            and the selected item: */
            var y, i, k, s, h, sl, yl;
            s = this.parentNode.parentNode.getElementsByTagName("select")[0];
            sl = s.length;
            h = this.parentNode.previousSibling;
            for (i = 0; i < sl; i++) {
              if (s.options[i].innerHTML == this.innerHTML) {
                s.selectedIndex = i;
                h.innerHTML = this.innerHTML;
                y = this.parentNode.getElementsByClassName("same-as-selected");
                yl = y.length;
                for (k = 0; k < yl; k++) {
                  y[k].removeAttribute("class");
                }
                this.setAttribute("class", "same-as-selected");
                var event = new Event(\'change\', { \'bubbles\': true }); // Create a change event
                s.dispatchEvent(event); // Dispatch it
                break;
              }
            }
            h.click();
        });
        b.appendChild(c);
      }
      x[i].appendChild(b);
      a.addEventListener("click", function(e) {
        /* When the select box is clicked, close any other select boxes,
        and open/close the current select box: */
        e.stopPropagation();
        closeAllSelect(this);
        this.nextSibling.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
      });
    }
    
    function closeAllSelect(elmnt) {
      /* A function that will close all select boxes in the document,
      except the current select box: */
      var x, y, i, xl, yl, arrNo = [];
      x = document.getElementsByClassName("select-items");
      y = document.getElementsByClassName("select-selected");
      xl = x.length;
      yl = y.length;
      for (i = 0; i < yl; i++) {
        if (elmnt == y[i]) {
          arrNo.push(i)
        } else {
          y[i].classList.remove("select-arrow-active");
        }
      }
      for (i = 0; i < xl; i++) {
        if (arrNo.indexOf(i)) {
          x[i].classList.add("select-hide");
        }
      }
    }
    document.addEventListener("click", closeAllSelect);
  });
');
?>

<?php if ($this->params->get('show_page_heading')): ?>
  <div class="relative z-10 w-full px-2 xl:px-8 lg:py-4 bg-light-taupe">
      <div class="page-header flex flex-wrap items-center gap-0 inner-space-title lg:gap-3">
          <?php echo ((isset($pageHeading)) ? $pageHeading : $this->escape($this->menu->getActive()->title)); ?>
      </div>
  </div>
<?php endif;?>
<div class="w-full">
  <p class="p-4 px-5 my-2 intro lg:p-8 lg:px-10">
    Here you will find videos of past events so you can catch up on what’ s
    been happening and hear what our speakers have been sharing in their
    classes and talks.
  </p>
</div>
<div class="relative p-4 lg:px-8 h-auto bg-light-cream">
  <form action="<?php echo Route::_('index.php?option=com_audiofiles'); ?>" method="post" name="adminForm" id="adminForm">

    <?php echo LayoutHelper::render('joomla.searchtools.audiosearch', array('view' => $this)); ?>

    <?php foreach ($this->items as $id => $item):
      $slug = preg_replace('/[^a-z\d]/i', '-', $item->title);
      $slug = strtolower(str_replace(' ', '-', $slug));
      ?>
      <div class="transition-all audio-container virtue-shadow">
            <div><img src="<?php echo Uri::root() . $this->escape($item->thumbnail); ?>" alt="<?php echo $item->title; ?>" class="object-cover w-full lg:h-[15rem] aspect-video rounded-15px animation-hover"></div>
        <div class="flex flex-col justify-between w-full col-span-4 lg:px-6">
            <h1 class="audio-title"><?php echo $item->title; ?></h1>
            <section><div class="text-block audio-paragraph"><div class="text"><?php echo $item->description; ?></div><button class="toggle-btn underline cursor-pointer mr-autio text-deep-maroon">Read more</button></div></section>
            <div class="flex items-center justify-between w-full py-4">
                <audio controls="" class="w-full">
                    <source src="<?php echo Uri::root() . $this->escape($item->audio_file); ?>">
                    Your browser does not support the audio element.
                </audio>
            </div>
        </div>
      </div>
    <?php endforeach;?>
    <?php echo $this->pagination->getListFooter(); ?>
    <input type="hidden" name="task" value="">
    <input type="hidden" name="boxchecked" value="0">
    <?php echo HTMLHelper::_('form.token'); ?>

  </form>
</div>