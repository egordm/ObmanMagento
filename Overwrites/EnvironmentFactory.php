<?php


namespace EgorDm\Obman\Overwrites;


use EgorDm\Obman\Constants;
use EgorDm\Obman\Wrappers\ObmanEnvironment;

class EnvironmentFactory extends \Magento\Framework\App\EnvironmentFactory
{
    public function createEnvironment()
    {
        if(Constants::ENABLE_OBMAN) {
            return new ObmanEnvironment($this);
        }
        return parent::createEnvironment();
    }

}