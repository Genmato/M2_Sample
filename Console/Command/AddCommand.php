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
use Genmato\Sample\Model\Data\DemoFactory;
use Genmato\Sample\Api\Data\DemoInterface;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;


class AddCommand extends Command
{

    /** @var  DemoRepositoryInterface */
    private $demoRepository;

    /** @var DemoFactory  */
    private $demoFactory;

    /**
     * AddCommand constructor.
     * @param DemoRepositoryInterface $demoRepository
     * @param DemoFactory $demoFactory
     * @param null $name
     */
    public function __construct(
        DemoRepositoryInterface $demoRepository,
        DemoFactory $demoFactory,
        $name = null)
    {
        parent::__construct($name);

        $this->demoRepository = $demoRepository;
        $this->demoFactory = $demoFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('demo:add')
            ->setDescription('Add demo record')
            ->addArgument('title',InputArgument::OPTIONAL, 'Title')
            ->addOption('active', null, InputOption::VALUE_NONE, 'Active')
            ->addOption('visible', null, InputOption::VALUE_NONE, 'Visible')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $title = $input->getArgument('title');
        $active = $input->getOption('active')? 1:0;
        $visible = $input->getOption('visible')? 1:0;
        if (!$title) {
            $dialog = $this->getHelper('dialog');

            $title = $dialog->ask($output, '<question>Enter the Title:</question> ',false);
            $active = $dialog->ask($output, '<question>Should record be active: [Y/n]</question> ','y');
            $active = (strtolower($active) == 'y') ? 1:0;
            $visible = $dialog->ask($output, '<question>Should record be visible: [Y/n]</question> ','y');
            $visible = (strtolower($visible) == 'y') ? 1:0;
        }

        /** @var DemoInterface $demoRecord */
        $demoRecord = $this->demoFactory->create();
        $demoRecord->setIsActive($active)
            ->setIsVisible($visible)
            ->setTitle($title);

        try {
            $demo = $this->demoRepository->save($demoRecord);
            $output->writeln('New record created (id='.$demo->getId().')');
        }catch (\Exception $ex) {
            $output->writeln('<error>'.$ex->getMessage().'</error>');
        }
    }
}