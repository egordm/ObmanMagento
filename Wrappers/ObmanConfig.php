<?php


namespace EgorDm\Obman\Wrappers;


use Magento\Framework\ObjectManager\ConfigCacheInterface;
use Magento\Framework\ObjectManager\DefinitionInterface;
use Magento\Framework\ObjectManager\InterceptableValidator;
use Magento\Framework\ObjectManager\RelationsInterface;

/** @noinspection PhpUndefinedClassInspection */
class ObmanConfig
    implements \Magento\Framework\ObjectManager\ConfigInterface,
               \Magento\Framework\Interception\ObjectManager\ConfigInterface
{
    /** @var \EgorDm\Obman\Config */
    private $cppConfig;

    /**
     * @var InterceptableValidator
     */
    private $interceptableValidator;

    /**
     * @var \Magento\Framework\Interception\ConfigInterface
     */
    protected $interceptionConfig;


    /**
     * @param RelationsInterface $relations
     * @param DefinitionInterface $definitions
     * @param InterceptableValidator $interceptableValidator
     */
    public function __construct(
        RelationsInterface $relations = null,
        DefinitionInterface $definitions = null,
        InterceptableValidator $interceptableValidator = null
    ) {

        $this->interceptableValidator = $interceptableValidator ?: new InterceptableValidator();
        $this->cppConfig = new \EgorDm\Obman\Config();
        if($relations) {
            $this->setRelations($relations);
        }
    }

    /**
     * Set class relations
     *
     * @param RelationsInterface $relations
     *
     * @return void
     */
    public function setRelations(RelationsInterface $relations)
    {
        $this->cppConfig->setRelations($relations);
    }

    /**
     * Set configuration cache instance
     *
     * @param ConfigCacheInterface $cache
     *
     * @return void
     */
    public function setCache(ConfigCacheInterface $cache)
    {
        $this->cppConfig->setCache($cache);
    }

    /**
     * Retrieve list of arguments per type
     *
     * @param string $type
     * @return array|null
     */
    public function getArguments($type)
    {
        return $this->cppConfig->getArguments($type);
    }

    /**
     * Check whether type is shared
     *
     * @param string $type
     * @return bool
     */
    public function isShared($type)
    {
        return $this->cppConfig->isShared($type);
    }

    /**
     * Retrieve instance type
     *
     * @param string $instanceName
     * @return mixed
     */
    public function getInstanceType($instanceName)
    {
        $type = $this->cppConfig->getInstanceType($instanceName);
        if ($this->interceptionConfig && $this->interceptionConfig->hasPlugins($instanceName)
            && $this->interceptableValidator->validate($instanceName)
        ) {
            return $type . '\\Interceptor';
        }
        return $type;
    }

    /**
     * Retrieve preference for type
     *
     * @param string $type
     * @return string
     * @throws \LogicException
     */
    public function getPreference($type)
    {
        return $this->cppConfig->getPreference($type);
    }

    /**
     * Returns list of virtual types
     *
     * @return array
     */
    public function getVirtualTypes()
    {
        return $this->cppConfig->getVirtualTypes();
    }

    /**
     * Extend configuration
     *
     * @param array $configuration
     * @return void
     */
    public function extend(array $configuration)
    {
        $this->cppConfig->extend($configuration);
    }

    /**
     * Returns list on preferences
     *
     * @return array
     */
    public function getPreferences()
    {
        return $this->cppConfig->getPreferences();
    }

    /**
     * Set Interception config
     *
     * @param \Magento\Framework\Interception\ConfigInterface $interceptionConfig
     * @return void
     */
    public function setInterceptionConfig(\Magento\Framework\Interception\ConfigInterface $interceptionConfig)
    {
        $this->interceptionConfig = $interceptionConfig;
    }

    /**
     * Retrieve instance type without interception processing
     *
     * @param string $instanceName
     * @return string
     */
    public function getOriginalInstanceType($instanceName)
    {
        return $this->cppConfig->getInstanceType($instanceName);
    }
}