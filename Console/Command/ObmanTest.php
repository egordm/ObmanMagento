<?php


namespace EgorDm\Obman\Console\Command;

use EgorDm\Obman\Wrappers\ObmanFactory;
use EgorDm\Obman\Wrappers\ObmanObjectManager;
use Magento\Framework\ObjectManager\ConfigInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Test {

    /**
     * Test constructor.
     */
    public function __construct(array $ello = [])
    {
    }
}

class ObmanTest extends Command
{
    /**
     * TestObman constructor.
     * @param ConfigInterface $config
     */
    public function __construct(
        ConfigInterface $config,
        string $name = null
    )
    {
        $this->config = $config;
        parent::__construct($name);
    }


    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $output->writeln("Hello World");
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("egordm_obman:test_obman");
        $this->setDescription("Tests object manager");
        parent::configure();
    }
}
