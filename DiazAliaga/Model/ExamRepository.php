<?php

namespace Hiberus\DiazAliaga\Model;

use Hiberus\DiazAliaga\Api\Data\ExamInterfaceFactory;
use Hiberus\DiazAliaga\Api\Data\ExamSearchResultsInterface;
use Hiberus\DiazAliaga\Model\ResourceModel\Exam\Collection;
use Hiberus\DiazAliaga\Model\ResourceModel\Exam\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Hiberus\DiazAliaga\Api\Data;
use Hiberus\DiazAliaga\Api\ExamRepositoryInterface;
use Hiberus\DiazAliaga\Model\ResourceModel;

/**
 * Class ExamRepository
 * @package Hiberus\DiazAliaga\Model
 */
class ExamRepository implements ExamRepositoryInterface
{
    /**
     * @var \Hiberus\DiazAliaga\Model\ResourceModel\Exam
     */
    private $resourceExam;

    /**
     * @var ExamInterfaceFactory
     */
    private $examFactory;

    /**
     * @var CollectionFactory
     */
    private $examCollectionFactory;

    /**
     * @var Data\ExamSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var ManagerInterface
     */
    private $eventManager;

    /**
     * @param \Hiberus\DiazAliaga\Model\ResourceModel\Exam $resourceExam
     * @param ExamInterfaceFactory $examFactory
     * @param CollectionFactory $examCollectionFactory
     * @param Data\ExamSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param ManagerInterface $eventManager
     */
    function __construct(
        ResourceModel\Exam $resourceExam,
        ExamInterfaceFactory $examFactory,
        CollectionFactory $examCollectionFactory,
        Data\ExamSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        ManagerInterface $eventManager
    ) {
        $this->resourceExam = $resourceExam;
        $this->examFactory = $examFactory;
        $this->examCollectionFactory = $examCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->eventManager = $eventManager;
    }

    /**
     * @param Data\ExamInterface $exam
     * @return Data\ExamInterface
     * @throws CouldNotSaveException
     */
    public function save(Data\ExamInterface $exam)
    {
        try {
            $this->resourceExam->save($exam);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $exam;
    }

    /**
     * @param int $examId
     * @return Data\ExamInterface
     * @throws NoSuchEntityException
     */
    public function getById($examId)
    {
        $exam = $this->examFactory->create();
        $this->resourceExam->load($exam, $examId);
        if (!$exam->getId()) {
            throw new NoSuchEntityException(__('exam with id "%1" does not exist', $examId));
        }
        return $exam;
    }

    /**
     * @param Data\ExamInterface $exam
     * @return bool|Data\ExamInterface
     * @throws CouldNotSaveException
     */
    public function delete(Data\ExamInterface $exam)
    {
        try {
            $this->resourceExam->delete($exam);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $exam;
    }

    /**
     * @param int $examId
     * @return bool|Data\ExamInterface
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function deleteById($examId)
    {
        return $this->delete($this->getById($examId));
    }

    /**
     * Filtra los elementos recibiendo el searchCriteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return ExamSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->examCollectionFactory->create();
        //Cada vez que hagamos una consulta a la bd necesitamos un Factory y una coleccion
        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var Data\ExamSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        $this->eventManager->dispatch(
            'hiberus_diaz_aliaga_exam_repository_get_list_after',
            [
                'search_results' => $searchResults
            ]
        );

        return $searchResults;
    }
}
