<?php

namespace Hiberus\DiazAliaga\Console\Command;

use Hiberus\DiazAliaga\Api\Data\ExamInterface;
use Hiberus\DiazAliaga\Api\ExamRepositoryInterface;
use Hiberus\DiazAliaga\Console\Command\Input\ShowExams\ListInputValidator;
use Hiberus\DiazAliaga\Console\Command\Options\ShowExams\ListOptions;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Console\Cli;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

/**
 * Class ShowExamsCommand
 * @package Hiberus\DiazAliaga\Console\Command
 */
class ShowExamsCommand extends Command
{
    const   DETAIL_TAG  =   'detail';

    /**
     * @var ListInputValidator
     */
    protected $validator;

    /**
     * @var ListOptions
     */
    protected $listOptions;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var ExamRepositoryInterface
     */
    private $examRepository;


    /**
     * ShowExamsCommand constructor.
     * @param ListInputValidator $validator
     * @param ListOptions $listOptions
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param ExamRepositoryInterface $examRepository
     * @param string|null $name
     */
    public function __construct(
        ListInputValidator $validator,
        ListOptions $listOptions,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ExamRepositoryInterface $examRepository,
        string $name = null
    ) {
        $this->validator = $validator;
        $this->listOptions = $listOptions;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->examRepository = $examRepository;

        parent::__construct($name);
    }

    /**
     * Configure
     */
    protected function configure()
    {
        $this->setName('hiberus:exams:show')
            ->setDescription('Show Exams List')
            ->setDefinition($this->listOptions->getOptionsList());

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws LocalizedException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $time = microtime(true);
            $this->initFormatter($output);

            $this->process($input, $output);

            $output->writeln('Execution time: ' . (microtime(true) - $time));

        return Cli::RETURN_SUCCESS;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    private function process(InputInterface $input, OutputInterface $output)
    {
        $this->validator->validate($input);

        /** @var ExamInterface $exam */
        foreach ($this->getExamList() as $exam) {
            $output->writeln(
                sprintf(
                    "<%s> >> Firstname: %s - Lastname: %s - Mark: %s <%s>",
                    self::DETAIL_TAG,
                    $exam->getFirstname(),
                    $exam->getLastname(),
                    $exam->getMark(),
                    self::DETAIL_TAG
                )
            );
        }

    }

    /**
     * @return ExamInterface[]
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    private function getExamList()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();

        $examResults = $this->examRepository->getList($searchCriteria)->getItems();

        if (empty($examResults)) {
            throw new NoSuchEntityException(
                __('No exam list found.')
            );
        }

        return $examResults;
    }

    /**
     * @param OutputInterface $output
     */
    private function initFormatter(OutputInterface $output)
    {
        /** @var OutputFormatterInterface $outputFormatter */
        $outputFormatter = $output->getFormatter();
        $outputFormatter->setStyle(self::DETAIL_TAG, new OutputFormatterStyle('yellow'));
    }
}
