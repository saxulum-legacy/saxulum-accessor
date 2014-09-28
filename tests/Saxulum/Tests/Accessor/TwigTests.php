<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Tests\Accessor\Helpers\AccessorHelper;

class TwigTests extends \PHPUnit_Framework_TestCase
{
    public function testTwig()
    {
        $object = new AccessorHelper();
        $object->setName('test');

        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/Resources/views');
        $twig = new \Twig_Environment($loader);

        $rendered = $twig->loadTemplate('test.html.twig')->render(array(
            'object' => $object,
        ));

        $this->assertEquals('test', trim($rendered));
    }
}
