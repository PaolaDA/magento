<?php


namespace Hiberus\DiazAliaga\Block;

use Hiberus\DiazAliaga\Api\ExamRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Hiberus\DiazAliaga\Helper\Config;
use Psr\log\LoggerInterface;

class Listado extends \Magento\Framework\View\Element\Template
{
    protected $_examRepository;
    protected $_searchCriteriaBuilder;
    protected $_sortOrderBuilder;
    protected $_config;
    /**
     * @var \Psr\log\LoggerInterface $logger
     */
    protected $logger;

    /**
     * Listado constructor.
     * @param \Hiberus\DiazAliaga\Api\ExamRepositoryInterface $examRepository
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Psr\log\LoggerInterface $logger
     * @param array $data
     */
    public function __construct(
        ExamRepositoryInterface $examRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder,
        \Magento\Framework\View\Element\Template\Context $context,
        \Psr\log\LoggerInterface $logger,
        \Hiberus\DiazAliaga\Helper\Config $config,

        array $data = []
    ) {
        $this->_config = $config;
        $this->logger = $logger;
        $this->_examRepository = $examRepository;
        $this->_searchCriteriaBuilder=$searchCriteriaBuilder;
        $this->_sortOrderBuilder = $sortOrderBuilder;
        parent::__construct($context, $data);
    }

    /**
     * List of exams
     * @return mixed
     */
    public function getListExams(){
        return $this->_examRepository->getList($this->_searchCriteriaBuilder
            ->addSortOrder($this->_sortOrderBuilder->setField('mark')->setDirection('desc')->create())
            ->setPageSize($this->_config->getEleList())
            ->create())->getItems();
    }

    public function logdebug($alumnos,$media){
        $this->logger->debug("Numero de alumnos que se muestran: ".$alumnos." - Nota media: ".$media);
    }
}
