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

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class DeleteCommand extends Command
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
        $this->setName('demo:delete')
            ->setDescription('Delete demo record')
            ->addOption(
                'id',
                null,
                InputOption::VALUE_REQUIRED,
                'Demo record ID to delete'
            )
            ->addOption(
                'force',
                null,
                InputOption::VALUE_NONE,
                'Force delete without confirmation'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');

        $id = $input->getOption('id');

        try {
            if (!$input->getOption('force')) {
                $data = $this->demoRepository->getById($id);
                $output->writeln('Id        :' . $data->getId());
                $output->writeln('Title     :' . $data->getTitle());
                $question = new ConfirmationQuestion('Are you sure you want to delete this record? ', false);

                if (!$helper->ask($input, $output, $question)) {
                    return;
                }
            }

            $data = $this->demoRepository->deleteById($id);
            if ($data) {
                $output->writeln('<info>Record deleted!</info>');
            } else {
                $output->writeln('<error>Unable to delete record!</error>');
            }
        } catch (\Exception $ex) {
            $output->writeln('<error>'.$ex->getMessage().'</error>');
        }
    }
}