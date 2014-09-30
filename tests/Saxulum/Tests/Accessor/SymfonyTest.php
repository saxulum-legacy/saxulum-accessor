<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Tests\Accessor\Fixtures\AccessorHelper;
use Saxulum\Tests\Accessor\Fixtures\Form\One2ManyType;
use Saxulum\Tests\Accessor\Fixtures\Mapping\One2Many;
use Symfony\Component\Form\Forms;
use Symfony\Component\PropertyAccess\PropertyAccess;

class SymfonyTest extends \PHPUnit_Framework_TestCase
{
    public function testPropertyAccess()
    {
        $object = new AccessorHelper();

        $accessor = PropertyAccess::createPropertyAccessor();
        $accessor->setValue($object, 'name', 'test');

        $this->assertEquals('test', $accessor->getValue($object, 'name'));
    }

    public function testForm()
    {
        $one = new One2Many();

        $formFactory = Forms::createFormFactoryBuilder()->getFormFactory();

        $form = $formFactory->createBuilder(new One2ManyType(), $one)->getForm();

        $form->submit(array(
            'manies' => array(
                array('name' => 'name1'),
                array('name' => 'name2')
            )
        ));

        $manies = $one->getManies();

        $this->assertCount(2, $manies);
        $this->assertEquals('name1', $manies[0]->getName());
        $this->assertEquals('name2', $manies[1]->getName());
    }
}
