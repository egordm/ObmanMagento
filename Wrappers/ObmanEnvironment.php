<?php


namespace EgorDm\Obman\Wrappers;


use EgorDm\Obman\Constants;

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

}