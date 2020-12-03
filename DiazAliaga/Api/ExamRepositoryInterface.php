<?php

namespace Hiberus\DiazAliaga\Api;

use Hiberus\DiazAliaga\Api\Data\ExamInterface;
use Hiberus\DiazAliaga\Api\Data\ExamSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Interface Hiberus\DiazAliaga\Api\Data\ExamRepositoryInterface
 * @package Hiberus\DiazAliaga\Api
 */
interface ExamRepositoryInterface
{
    /**
     * Save an Exam
     *
     * @param \Hiberus\DiazAliaga\Api\Data\ExamInterface $exam
     * @return \Hiberus\DiazAliaga\Api\Data\ExamInterface
     */
    public function save(\Hiberus\DiazAliaga\Api\Data\ExamInterface $exam);

    /**
     * Get Exam by an Id
     *
     * @param int $examId
     * @return \Hiberus\DiazAliaga\Api\Data\ExamInterface
     */
    public function getById($examId);

    /**
     * Retrieve exams matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Hiberus\DiazAliaga\Api\Data\ExamSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete a Exam
     *
     * @param \Hiberus\DiazAliaga\Api\Data\ExamInterface $exam
     * @return bool
     */
    public function delete(Data\ExamInterface $exam);

    /**
     * Delete a Exam by an Id
     *
     * @param int $examId
     * @return bool
     */
    public function deleteById($examId);
}
