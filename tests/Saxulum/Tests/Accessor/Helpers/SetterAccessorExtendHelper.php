<?php

namespace Saxulum\Tests\Accessor\Helpers;

/**
 * @method $this setValue(string $value)
 */
class SetterAccessorExtendHelper extends SetterAccessorHelper
{
    /**
     * @param  string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name . '_override';

        return $this;
    }
}
