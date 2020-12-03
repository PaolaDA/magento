<?php

namespace Hiberus\DiazAliaga\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Config
 * @package Hiberus\DiazAliaga\Helper
 */
class Config extends AbstractHelper
{
    const   XML_PATH_ELELIST=   'hiberus_diazaliaga/general_config_exam/eleList';
    const   XML_PATH_NOTA =   'hiberus_diazaliaga/general_config_exam/notaAprobado';

    public function getEleList()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_ELELIST
        );
    }

    public function getNote()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_NOTA
        );
    }
}
