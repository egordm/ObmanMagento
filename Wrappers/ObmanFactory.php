<?php


namespace EgorDm\Obman\Wrappers;


use Magento\Framework\ObjectManagerInterface;

class ObmanFactory implements \Magento\Framework\ObjectManager\FactoryInterface
{
    /** @var \EgorDm\Obman\Cpp\Factory */
    private $cppInstance;

    /**
     * ObmanFactory constructor.
     * @param ObmanConfig $config
     * @param ObmanObjectManager|null $objectManager
     * @param \Magento\Framework\ObjectManager\DefinitionInterface|null $definitions
     * @param array $globalArguments
     */
    public function __construct(
        ObmanConfig $config,
        ObmanObjectManager $objectManager = null,
        \Magento\Framework\ObjectManager\DefinitionInterface $definitions = null,
        $globalArguments = []
    )
    {
        $this->cppInstance = new \EgorDm\Obman\Cpp\Factory(
            $config->getCppInstance(),
            $objectManager ? $objectManager->getCppInstance() : null,
            $globalArguments
        );
    }


    /**
     * Create instance with call time arguments
     *
     * @param string $requestedType
     * @param array $arguments
     * @return object
     * @throws \LogicException
     * @throws \BadMethodCallException
     */
    public function create($requestedType, array $arguments = [])
    {
        return $this->cppInstance->create($requestedType, $arguments);
    }

    /**
     * Set object manager
     *
     * @param ObjectManagerInterface $objectManager
     *
     * @return void
     * @throws \Exception
     */
    public function setObjectManager(ObjectManagerInterface $objectManager)
    {
        if(!($objectManager instanceof ObmanObjectManager)) throw new \Exception('Expecting ObmanObjectManager');
        $this->cppInstance->setObjectManager($objectManager->getCppInstance());
    }

    /**
     * @return \EgorDm\Obman\Cpp\Factory
     */
    public function getCppInstance(): \EgorDm\Obman\Cpp\Factory
    {
        return $this->cppInstance;
    }
}