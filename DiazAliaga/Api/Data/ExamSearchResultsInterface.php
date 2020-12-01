<?php

namespace Hiberus\DiazAliaga\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface ExamSearchResultsInterface
 * @package Hiberus\DiazAliaga\Api\Data
 */
interface ExamSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get exam list.
     *
     * @return \Hiberus\DiazAliaga\Api\Data\ExamInterface[]
     */
    public function getItems();

    /**
     * Set exam list.
     *
     * @param \Hiberus\DiazAliaga\Api\Data\ExamInterface[] $items
     * @return \Hiberus\DiazAliaga\Api\Data\ExamSearchResultsInterface
     */
    public function setItems(array $items);
}
