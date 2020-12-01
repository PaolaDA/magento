<?php

namespace Hiberus\DiazAliaga\Model;

use Hiberus\DiazAliaga\Api\Data\ExamInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Tests\NamingConvention\true\mixed;

/**
 * Class Exam
 * @package Hiberus\Sample\Model
 */
class Exam extends AbstractModel implements ExamInterface
{

    protected function _construct()
    {
        $this->_init(\Hiberus\DiazAliaga\Model\ResourceModel\Exam::class);
    }

    /**
     * @return int|mixed
     */
    public function getId()
    {
        return $this->_getData(self::ID);
    }

    /**
     * @return mixed|string
     */
    public function getFirstname()
    {
        return $this->_getData(self::FIRSTNAME);
    }

    /**
     * @return mixed|string
     */
    public function getLastname()
    {
        return $this->_getData(self::LASTNAME);
    }

    /**
     * @return array|null
     */
    public function getMark()
    {
        return $this->_getData(self::MARK);
    }

    /**
     * @param int|mixed $id
     * @return ExamInterface|Exam|AbstractModel
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @param string $firstname
     * @return ExamInterface|Exam
     */
    public function setFirstname($firstname)
    {
        return $this->setData(self::FIRSTNAME, $firstname);
    }

    /**
     * @param string $lastname
     * @return ExamInterface|Exam
     */
    public function setLastName($lastname)
    {
        return $this->setData(self::LASTNAME, $lastname);
    }

    /**
     * @param array|null $mark
     * @return $this
     */
    public function setMark($mark)
    {
        return $this->setData(self::MARK, $mark);
    }


}
