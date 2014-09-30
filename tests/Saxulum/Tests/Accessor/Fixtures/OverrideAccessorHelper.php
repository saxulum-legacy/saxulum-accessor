<?php

namespace Saxulum\Tests\Accessor\Fixtures;

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
        return array_merge(parent::getValue(), array('override'));
    }
}
