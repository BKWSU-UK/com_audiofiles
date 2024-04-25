<?php
defined('_JEXEC') or die;

use Joomla\CMS\Component\Router\RouterFactoryInterface;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\CategoryFactory;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use BKWSU\Component\Audiofiles\Administrator\Extension\AudiofilesComponent;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

return new class implements ServiceProviderInterface
{
    /**
     * Registers the service provider with a DI container.
     *
     * @param   Container  $container  The DI container.
     * @return  void
     */
    public function register(Container $container)
    {
        //$container->registerServiceProvider(new Component('com_audiofiles'));
        //$container->registerServiceProvider(new MVCFactory('com_audiofiles'));
        $container->registerServiceProvider(new CategoryFactory('\\BKWSU\\Component\\Audiofiles'));
        $container->registerServiceProvider(new MVCFactory('\\BKWSU\\Component\\Audiofiles'));
        $container->registerServiceProvider(new ComponentDispatcherFactory('\\BKWSU\\Component\\Audiofiles'));
        $container->registerServiceProvider(new RouterFactory('\\BKWSU\\Component\\Audiofiles'));
        $container->set(
            ComponentInterface::class,
            function (Container $container) {
                $component = new AudiofilesComponent($container->get(ComponentDispatcherFactoryInterface::class));

                $component->setRegistry($container->get(Registry::class));
                $component->setMVCFactory($container->get(MVCFactoryInterface::class));
                //					$component->setCategoryFactory($container->get(CategoryFactoryInterface::class));
                $component->setRouterFactory($container->get(RouterFactoryInterface::class));

                return $component;
            }
        );
    }
};
