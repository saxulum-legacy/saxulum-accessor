<?php

namespace Saxulum\Tests\Accessor\Helpers;

class OverrideAccessorHelper extends AccessorHelper
{
    /**
     * @return string
     */
    public function getName()
    {
        return parent::getName() . '_override';
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return parent::getValue() . '_override';
    }

    /**
     * @return bool
     */
    public function isName()
    {
        parent::isName();

        return false;
    }

    /**
     * @return bool
     */
    public function isValue()
    {
        parent::isValue();

        return false;
    }
}
