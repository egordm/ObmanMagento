<?php


namespace EgorDm\Obman\Overwrites;


use EgorDm\Obman\Constants;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Config\File\ConfigFilePool;
use Magento\Framework\Interception\ObjectManager\ConfigInterface;

class ObjectManagerFactory extends \Magento\Framework\App\ObjectManagerFactory
{
    protected $_locatorClassName = Constants::ENABLE_OBMAN ?
        \EgorDm\Obman\Wrappers\ObmanObjectManager::class :
        \Magento\Framework\App\ObjectManager::class;

    protected $envFactoryClassName = \EgorDm\Obman\Overwrites\EnvironmentFactory::class;
}