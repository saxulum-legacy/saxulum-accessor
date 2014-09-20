<?php

namespace Saxulum\Tests\Accessor\Helpers;

class OverrideAccessorHelper extends AccessorHelper
{
    public function getName()
    {
        return parent::getName() . '_override';
    }

    public function getValue()
    {
        return parent::getValue() . '_override';
    }
}
