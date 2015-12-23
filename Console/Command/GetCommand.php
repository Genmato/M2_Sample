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

use Genmato\Sample\Api\DemoRepositoryInterface;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetCommand extends Command
{

    /** @var  DemoRepositoryInterface */
    private $demoRepository;

    public function __construct(
        DemoRepositoryInterface $demoRepository,
        $name = null)
    {
        parent::__construct($name);

        $this->demoRepository = $demoRepository;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('demo:get')
            ->setDescription('Get demo records')
            ->addOption(
                'id',
                null,
                InputOption::VALUE_REQUIRED,
                'Demo record ID to display'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getOption('id');

        try {
            $data = $this->demoRepository->getById($id);

            $table = $this->getHelper('table');
            $table
                ->setHeaders(array(__('ID'), __('Title'), __('Created'), __('Updated'), __('Visible'), __('Active')))
                ->setRows([[
                    $data->getId(),
                    $data->getTitle(),
                    $data->getCreationTime(),
                    $data->getUpdateTime(),
                    $data->getIsVisible() ? __('Yes') : __('No'),
                    $data->getIsActive() ? __('Yes') : __('No')
                ]]);
            $table->render($output);
        } catch (\Exception $ex) {
            $output->writeln('<error>'.$ex->getMessage().'</error>');
        }
    }
}