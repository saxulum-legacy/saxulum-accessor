<?php

namespace Saxulum\Tests\Accessor;

use Doctrine\Common\Persistence\Mapping\RuntimeReflectionService;
use Doctrine\Common\Proxy\ProxyGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;
use Saxulum\Accessor\AccessorRegistry;
use Saxulum\Accessor\Accessors\Add;
use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Is;
use Saxulum\Accessor\Accessors\Remove;
use Saxulum\Accessor\Accessors\Set;
use Saxulum\Tests\Accessor\Helpers\AccessorHelper;
use Saxulum\Tests\Accessor\Helpers\OverrideAccessorHelper;
use Symfony\Component\PropertyAccess\PropertyAccess;

class AccessorTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testRegistry()
    {
        $accessors = AccessorRegistry::getAccessors();

        $this->assertEquals(array(Add::PREFIX, Get::PREFIX, Is::PREFIX, Remove::PREFIX, Set::PREFIX), array_keys($accessors));
    }

    public function testRegistryOverride()
    {
        $this->setExpectedException('Exception', 'Override Accessor is not allowed, to enhance stability!');

        AccessorRegistry::registerAccessor(new Get());
    }

    public function testCall()
    {
        $object = new AccessorHelper();
        $object->setName('test');
        $object->addValue('test');

        $this->assertEquals('test', $object->getName());
        $this->assertTrue($object->isName());

        $this->assertEquals('test', $object->getValue()[0]);
        $this->assertTrue($object->isValue());

        $object->removeValue('test');

        $this->assertCount(0, $object->getValue());
        $this->assertFalse($object->isValue());
    }

    public function testCallOverride()
    {
        $object = new OverrideAccessorHelper();
        $object->setName('test');
        $object->addValue('test');

        $this->assertEquals('test_override', $object->getName());
        $this->assertEquals('test', $object->getValue()[0]);
        $this->assertEquals('override', $object->getValue()[1]);

        $object->removeValue('test');

        $this->assertCount(1, $object->getValue());
    }

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

    public function testSymfonyPropertyAccess()
    {
        $object = new AccessorHelper();

        $accessor = PropertyAccess::createPropertyAccessor();
        $accessor->setValue($object, 'name', 'test');

        $this->assertEquals('test', $accessor->getValue($object, 'name'));
    }

    public function testDoctrineProxy()
    {
        $className = 'Saxulum\Tests\Accessor\Helpers\AccessorHelper';

        $proxyDirectory = __DIR__ . '/../../../../proxy/';
        $proxyNamespace = 'Proxy';
        $proxyClassName = $proxyNamespace . '\__CG__\\' . $className;
        $proxyClassFilename = $proxyDirectory . str_replace('\\', '_', $proxyClassName) . '.php';

        if (!is_dir($proxyDirectory)) {
            mkdir($proxyDirectory, 0777, true);
        }

        $reflectionService = new RuntimeReflectionService();

        $classMetadata = new ClassMetadata(get_class(new AccessorHelper()));
        $classMetadata->initializeReflection($reflectionService);

        $proxyGenerator = new ProxyGenerator($proxyDirectory, $proxyNamespace);
        $proxyGenerator->generateProxyClass($classMetadata, $proxyClassFilename);

        require $proxyClassFilename;

        $proxy = new $proxyClassName();

        $proxy->setName('test');

        $this->assertEquals('test', $proxy->getName());

        unlink($proxyClassFilename);
        rmdir($proxyDirectory);
    }
}
