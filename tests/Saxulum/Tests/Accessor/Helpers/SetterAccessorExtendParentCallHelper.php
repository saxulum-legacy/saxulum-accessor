<?php

namespace Saxulum\Tests\Accessor\Helpers;

/**
 * @method $this setValue(string $value)
 */
class SetterAccessorExtendParentCallHelper extends SetterAccessorHelper
{
    /**
     * @param  string $name
     * @return $this
     */
    public function setName($name)
    {
        parent::setName($name);

        $this->name .= '_override';

        return $this;
    }
}
