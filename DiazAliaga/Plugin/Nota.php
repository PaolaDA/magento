<?php
namespace Hiberus\DiazAliaga\Plugin;

use Hiberus\DiazAliaga\Api\Data\ExamInterface;
use Hiberus\DiazAliaga\Api\Data\ExamSearchResultsInterface;
use Hiberus\DiazAliaga\Api\ExamRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Nota
 * @package Hiberus\DiazAliaga\Plugin
 */
class Nota
{

    /**
     * @param ExamRepositoryInterface $subject
     * @param ExamSearchResultsInterface $result
     * @return ExamSearchResultsInterface
     */
    public function afterGetList(
        ExamRepositoryInterface $subject,
        $result
    ) {
        /** @var ExamInterface $first */

        foreach ($result->getItems() as $exam){
            if($exam->getMark() < 5){
                $exam->setMark('4.9');
            }
        }

        return $result;
    }
}
