<?php

namespace Saxulum\Tests\Accessor\Helpers\Mapping;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Saxulum\Accessor\Accessors\Add;
use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Remove;
use Saxulum\Accessor\Accessors\Set;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\Prop;

/**
 * @method Many2Many[] getManies()
 * @method $this addManies(Many2Many $many, $stopPropagation = false)
 * @method $this removeManies(Many2Many $many, $stopPropagation = false)
 * @method $this setManies(array $manies)
 */
class Many2Many
{
    use AccessorTrait;

    /**
     * @var Collection|Many2Many[]
     */
    protected $manies;

    public function __construct()
    {
        $this->manies = new ArrayCollection();
    }

    protected function initializeProperties()
    {
        $this->prop(
            (new Prop('manies', 'Saxulum\Tests\Accessor\Helpers\Mapping\Many2Many[]', true, 'manies', Prop::REMOTE_MANY))
                ->method(Add::PREFIX)
                ->method(Get::PREFIX)
                ->method(Remove::PREFIX)
                ->method(Set::PREFIX)
        );
    }
}
