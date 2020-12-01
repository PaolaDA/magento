<?php

namespace Hiberus\DiazAliaga\Setup\Patch\Data;

use Hiberus\DiazAliaga\Api\Data\ExamInterface;
use Hiberus\DiazAliaga\Api\Data\ExamInterfaceFactory;
use Hiberus\DiazAliaga\Api\ExamRepositoryInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\HTTP\Client\CurlFactory;

/**
 * Class PopulateDataModel
 * @package Hiberus\DiazAliaga\Setup\Patch\Data
 */
class PopulateDataModel implements DataPatchInterface
{
    const   NUMBER_OF_EXAMS  =   5;

    /**
     * @var ExamRepositoryInterface
     */
    private $examRepository;

    /**
     * @var ExamInterfaceFactory
     */
    private $examFactory;

    /**
     * @var CurlFactory
     */
    private $curlFactory;

    /**
     * PopulateDataModel constructor.
     * @param ExamRepositoryInterface $examRepository
     * @param ExamInterfaceFactory $examFactory
     * @param CurlFactory $curlFactory
     */
    public function __construct(
        ExamRepositoryInterface $examRepository,
        ExamInterfaceFactory $examFactory,
        CurlFactory $curlFactory
    ) {
        $this->examRepository = $examRepository;
        $this->examFactory = $examFactory;
        $this->curlFactory = $curlFactory;
    }

    /**
     * @return DataPatchInterface|void
     */
    public function apply()
    {
        $this->populateData();
    }

    /**
     * Populate Data Model
     */
    private function populateData()
    {
        $this->populateExams();
    }

    /**
     * Populate Exams Data
     */
    private function populateExams()
    {
        for ($i = 0; $i < self::NUMBER_OF_EXAMS; $i++) {

            /** @var ExamInterface $exam */
            $exam = $this->examFactory->create();

            $exam->setFirstname('pepe')
                ->setLastName('martinez')
                ->setMark(rand(0*100,10*100)/100)
            ;

            $this->examRepository->save(
                $exam
            );
        }
    }

    /**
     * @return string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return string[]
     */
    public function getAliases()
    {
        return [];
    }
}
