<?php /** @noinspection ALL */


namespace EgorDm\Obman\Wrappers;


class ObmanObjectManager implements \Magento\Framework\ObjectManagerInterface
{
    /** @var \EgorDm\Obman\Cpp\ObjectManager */
    private $cppInstance;

    /**
     * ObmanObjectManager constructor.
     * @param ObmanConfig $config
     * @param ObmanFactory $factory
     * @param array $sharedInstances
     */
    public function __construct(
        ObmanFactory $factory,
        ObmanConfig $config,
        &$sharedInstances = []
    )
    {
        $this->cppInstance = new \EgorDm\Obman\Cpp\ObjectManager(
            $config->getCppInstance(),
            $factory->getCppInstance(),
            $sharedInstances
        );
        \Magento\Framework\App\ObjectManager::setInstance($this);
        $this->cppInstance->addSharedInstance(\Magento\Framework\ObjectManagerInterface::class, $this);
    }

    /**
     * Create new object instance
     *
     * @param string $type
     * @param array $arguments
     * @return mixed
     */
    public function create($type, array $arguments = [])
    {
        return $this->cppInstance->create($type, $arguments);
    }

    /**
     * Retrieve cached object instance
     *
     * @param string $type
     * @return mixed
     */
    public function get($type)
    {
        return $this->cppInstance->get($type);
    }

    /**
     * Configure object manager
     *
     * @param array $configuration
     * @return void
     */
    public function configure(array $configuration)
    {
        $this->cppInstance->configure($configuration);
    }

    /**
     * @return \EgorDm\Obman\Cpp\ObjectManager
     */
    public function getCppInstance(): \EgorDm\Obman\Cpp\ObjectManager
    {
        return $this->cppInstance;
    }

    /**
     * @param string $type
     * @param $object
     */
    public function addSharedInstance($type, $object)
    {
        $this->cppInstance->addSharedInstance($type, $object);

    }
}