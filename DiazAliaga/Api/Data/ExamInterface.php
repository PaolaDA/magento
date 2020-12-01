<?php

namespace Hiberus\DiazAliaga\Api\Data;

/**
 * Interface ExamInterface
 * @package Hiberus\DiazAliaga\Api\Data
 */
interface ExamInterface{

    const TABLE =   'hiberus_exam';
    const   ID      =   'id_exam';
    const   FIRSTNAME   =   'firstname';
    const   LASTNAME    =   'lastname';
    const   MARK  =   'mark';

    /**
     * Get Exam ID
     * @return int
     */
    public function getId();

    /**
     * Set Exam ID
     * @param int $id
     * @return ExamInterface
     */
    public function setId($id);

    /**
     * Set Firstname
     * @param string $firstname
     * @return ExamInterface
     */
    public function setFirstname($firstname);

    /**
     * Get Firstname
     * @return string
     */
    public function getFirstname();

    /**
     * Set Lastname
     * @param string $lastname
     * @return ExamInterface
     */
    public function setLastName($lastname);

    /**
     * Get Lastname
     * @return string
     */
    public function getLastname();

    /**
     * Get Mark
     * @return string
     */
    public function getMark();

    /**
     * Set Mark
     * @param float $mark
     * @return ExamInterface
     */
    public function setMark($mark);

}
