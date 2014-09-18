<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\AbstractAccessor;
use Saxulum\Accessor\Accessors\GetterAccessor;
use Saxulum\Accessor\Accessors\IsAccessor;
use Saxulum\Accessor\Accessors\SetterAccessor;
use Saxulum\Accessor\AccessorTrait;

/**
 * @method $this setName(string $name)
 * @method string getName()
 * @method boolean isName()
 */
class GetterSetterIsAccessorBlackListHelper
{
    use AccessorTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $value;

    public function __construct()
    {
        $this
            ->addAccessor((new GetterAccessor())
                ->addProperty('value')
                ->mode(AbstractAccessor::MODE_BLACKLIST)
            )
            ->addAccessor((new IsAccessor())
                ->addProperty('value')
                ->mode(AbstractAccessor::MODE_BLACKLIST)
            )
            ->addAccessor((new SetterAccessor())
                ->addProperty('value')
                ->mode(AbstractAccessor::MODE_BLACKLIST)
            )
        ;
    }
}
