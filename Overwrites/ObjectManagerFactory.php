<?php


namespace EgorDm\Obman\Overwrites;


use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Config\File\ConfigFilePool;

class ObjectManagerFactory extends \Magento\Framework\App\ObjectManagerFactory
{
    protected $_locatorClassName = \Magento\Framework\App\ObjectManager::class;

    protected $envFactoryClassName = \EgorDm\Obman\Overwrites\EnvironmentFactory::class;
}