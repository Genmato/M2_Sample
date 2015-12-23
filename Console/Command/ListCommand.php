<?php
/**
 * Sample
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-12-23
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Console\Command;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Genmato\Sample\Api\DemoRepositoryInterface;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListCommand extends Command
{

    /** @var  DemoRepositoryInterface */
    private $demoRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    public function __construct(
        DemoRepositoryInterface $demoRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        $name = null)
    {
        parent::__construct($name);

        $this->demoRepository = $demoRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('demo:list')->setDescription('List demo records');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Get list of available records
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchResult = $this->demoRepository->getList($searchCriteria);
        $rows = [];
        foreach ($searchResult->getItems() as $item) {
            $rows[] = [$item->getId(), $item->getTitle()];
        }

        $table = $this->getHelper('table');
        $table
            ->setHeaders(array(__('ID'), __('Title')))
            ->setRows($rows)
        ;
        $table->render($output);
    }
}