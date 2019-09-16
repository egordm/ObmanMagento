<?php


namespace EgorDm\Obman\Console\Command;

use EgorDm\Obman\Wrappers\ObmanFactory;
use EgorDm\Obman\Wrappers\ObmanObjectManager;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\ObjectManager\ConfigInterface;
use Magento\Quote\Model\Quote;
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
        $om = ObjectManager::getInstance();

        $start = microtime(true);
        $data = $om->create(\Magento\Sales\Model\Order::class);
        $data = $om->create(\Magento\Quote\Model\Quote::class);
        $data = $om->create(\Magento\Catalog\Block\Adminhtml\Form::class);
        $data = $om->create(\Magento\Catalog\Block\Adminhtml\Product::class);
        $data = $om->create(\Magento\Checkout\Block\Cart::class);
        $data = $om->create(\Magento\Checkout\Block\Registration::class);
        $data = $om->create(\Magento\Swagger\Block\Index::class);
        $data = $om->create(\Magento\Tax\Block\Checkout\Tax::class);
        $data = $om->create(\Magento\Theme\Block\Html\Header::class);
        $data = $om->create(\Magento\Wishlist\Block\Customer\Wishlist::class);
        $data = $om->create(\Magento\Customer\Helper\View::class);
        $data = $om->create(\Magento\Customer\Helper\View::class);
        $data = $om->create(\Magento\Sales\Helper\Data::class);
        $data = $om->create(\Magento\Catalog\Helper\Data::class);
        $data = $om->create(\Magento\Catalog\Helper\Product::class);
        $end = microtime(true);

        $output->writeln("Spent " . ($end - $start) . "s loading dependency.");
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
