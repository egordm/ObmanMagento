<?php


namespace EgorDm\Obman\Overwrites;


use Magento\Framework\App\ObjectManagerFactory;

class Bootstrap extends \Magento\Framework\App\Bootstrap
{
    public static function create($rootDir, array $initParams, ObjectManagerFactory $factory = null)
    {
        self::populateAutoloader($rootDir, $initParams);
        if ($factory === null) {
            $factory = self::createObjectManagerFactory($rootDir, $initParams);
        }
        return new self($factory, $rootDir, $initParams);
    }


    public static function createObjectManagerFactory($rootDir, array $initParams)
    {
        $dirList = self::createFilesystemDirectoryList($rootDir, $initParams);
        $driverPool = self::createFilesystemDriverPool($initParams);
        $configFilePool = self::createConfigFilePool();
        return new \EgorDm\Obman\Overwrites\ObjectManagerFactory($dirList, $driverPool, $configFilePool);
    }

}