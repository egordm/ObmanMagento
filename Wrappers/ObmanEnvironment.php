<?php


namespace EgorDm\Obman\Wrappers;


class ObmanEnvironment extends \Magento\Framework\App\ObjectManager\Environment\Developer
{
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