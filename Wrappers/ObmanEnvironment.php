<?php


namespace EgorDm\Obman\Wrappers;


use EgorDm\Obman\Constants;
use Magento\Framework\App\Area;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Interception\ObjectManager\ConfigInterface;

class ObmanEnvironment extends \Magento\Framework\App\ObjectManager\Environment\Developer
{
    protected $configPreference = Constants::ENABLE_OBMAN
        ? \EgorDm\Obman\Wrappers\ObmanFactory::class
        : \Magento\Framework\ObjectManager\Factory\Dynamic\Developer::class;

    public function getDiConfig()
    {
        if (!$this->config) {
            $this->config = new \EgorDm\Obman\Wrappers\ObmanConfig(
                $this->envFactory->getRelations(),
                $this->envFactory->getDefinitions()
            );
        }

        return parent::getDiConfig();
    }

    public function configureObjectManager(ConfigInterface $diConfig, &$sharedInstances)
    {
        $originalSharedInstances = $sharedInstances;
        $objectManager = ObjectManager::getInstance();
        $objectManager->addSharedInstance(
            \Magento\Framework\ObjectManager\ConfigLoaderInterface::class,
            $objectManager->get(\Magento\Framework\App\ObjectManager\ConfigLoader::class)
        );

        $diConfig->setCache(
            $objectManager->get(\Magento\Framework\App\ObjectManager\ConfigCache::class)
        );

        $objectManager->configure(
            $objectManager
                ->get(\Magento\Framework\App\ObjectManager\ConfigLoader::class)
                ->load(Area::AREA_GLOBAL)
        );
        $objectManager->get(\Magento\Framework\Config\ScopeInterface::class)
            ->setCurrentScope('global');
        $diConfig->setInterceptionConfig(
            $objectManager->get(\Magento\Framework\Interception\Config\Config::class)
        );
        /** Reset the shared instances once interception config is set so classes can be intercepted if necessary */
        $sharedInstances = $originalSharedInstances;
        $objectManager->addSharedInstance(
            \Magento\Framework\ObjectManager\ConfigLoaderInterface::class,
            $objectManager->get(\Magento\Framework\App\ObjectManager\ConfigLoader::class)
        );
    }
}