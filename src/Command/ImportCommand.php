<?php 

namespace FeedReader\Command;

use FeedReader\Dataprovider\DataSourceMapper;
use FeedReader\Dataprovider\Assortment\DataSource\FeedFactory;
use FeedReader\Dataprovider\Assortment\ProductDataProvider;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

class ImportCommand extends Command
{
    public function configure()
    {
        $this->setName('import')
            ->setDescription('Data import.')
            ->setHelp('This command allows you to import data');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->printMappedJson();
        $this->printMappedCsv();

        return 0;
    }

    private function printMappedJson()
    {
        $type = "json";

        $source = FeedFactory::getReader($type);
        $mapper = new DataSourceMapper(FeedFactory::getMapper($type));

        $dataProvider = new ProductDataProvider(
            $source->read(),
            $mapper
        );
        var_dump($dataProvider->getProducts());
    }

    private function printMappedCsv()
    {
        $type = "csv";

        $source = FeedFactory::getReader($type);
        $mapper = new DataSourceMapper(FeedFactory::getMapper($type));

        $dataProvider = new ProductDataProvider(
            $source->read(),
            $mapper
        );
        var_dump($dataProvider->getProducts());
    }
}
