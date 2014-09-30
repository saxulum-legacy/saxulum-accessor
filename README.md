# saxulum-accessor

[![Build Status](https://api.travis-ci.org/saxulum/saxulum-accessor.png?branch=master)](https://travis-ci.org/saxulum/saxulum-accessor)
[![Total Downloads](https://poser.pugx.org/saxulum/saxulum-accessor/downloads.png)](https://packagist.org/packages/saxulum/saxulum-accessor)
[![Latest Stable Version](https://poser.pugx.org/saxulum/saxulum-accessor/v/stable.png)](https://packagist.org/packages/saxulum/saxulum-accessor)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/saxulum/saxulum-accessor/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/saxulum/saxulum-accessor/?branch=master)

## Features

 * Contains a [accessor trait][1] which allows to register accessors
 * Contains a [add accessor][2], which means you don't have to write simple adders anymore
 * Contains a [get accessor][3], which means you don't have to write simple getters anymore
 * Contains a [is accessor][4], which means you don't have to write simple is anymore
 * Contains a [remove accessor][5], which means you don't have to write simple removers anymore
 * Contains a [set accessor][6], which means you don't have to write simple setters anymore


## Requirements

 * PHP 5.4+


## Installation

Through [Composer](http://getcomposer.org) as [saxulum/saxulum-accessor][7].

### Bootstrap:

``` {.php}
AccessorRegistry::registerAccessor(new Add());
AccessorRegistry::registerAccessor(new Get());
AccessorRegistry::registerAccessor(new Is());
AccessorRegistry::registerAccessor(new Remove());
AccessorRegistry::registerAccessor(new Set());
```

## Usage

``` {.php}
/**
 * @method $this setName(string $name)
 * @method string getName()
 * @method $this setActive(bool $active)
 * @method bool isActive()
 * @method $this addManies(Many $many)
 * @method $this removeManies(Many $many)
 * @method Many[] getManies()
 */
class One
{
    use AccessorTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $active;

    /**
     * @var Many[]
     */
    protected $manies = array();

    protected function _initProps()
    {
        $this
            ->_prop((new Prop('name', Hint::STRING))
                ->method(Get::PREFIX)
                ->method(Set::PREFIX)
            )
            ->_prop((new Prop('active', Hint::BOOL))
                ->method(Is::PREFIX)
                ->method(Set::PREFIX)
            )
            ->_prop((new Prop('manies', 'Many[]', true, 'one', Prop::REMOTE_ONE))
                ->method(Add::PREFIX)
                ->method(Get::PREFIX)
                ->method(Remove::PREFIX)
            )
        ;
    }
}

/**
 * @method $this setName(string $name)
 * @method string getName()
 * @method $this setOne(One $name)
 * @method One getOne()
 */
class Many
{
    use AccessorTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var One
     */
    protected $one;

    protected function _initProps()
    {
        $this
            ->_prop((new Prop('name', Hint::STRING))
                ->method(Get::PREFIX)
                ->method(Set::PREFIX)
            )
            ->_prop((new Prop('one', 'One', true, 'manies', Prop::REMOTE_MANY))
                ->method(Add::PREFIX)
                ->method(Get::PREFIX)
                ->method(Remove::PREFIX)
            )
        ;
    }
}

$one = new One();
$one
    ->setName('one')
    ->setActive(true)
;

$many = new Many();
$many
    ->setName('many')
    ->setOne($one)
;

$one->getName(); // return: string 'one'
$one->isActive(); // return: bool true
$one->getManies(); // return: an array with one instance of 'Many'
```


### PhpDoc generation

Call the method `_generatePhpDoc` on the object using it

``` {.php}
$one = new One();
$one->_generatePhpDoc()
```


## Arguments

### Pros:

- less own code to write
- less owm code to debug
- scalar type hints
- handles bidirection relations

### Cons:

- no auto generation of `@method` phpdoc (not yet)
- slower (no benchmark)
- more complex to debug
- `method_exists` does not work


## FAQ

#### Does it work with doctrine [orm][8]/[odm][9] (proxy)

Yes it does, thx to [__call][10]

#### Does ist work with [symfony/property-access][11] ([symfony/form][12])

Yes it does, thx to [__get][13], [__set][14]

#### Does it work with [twig][15]

Yes it does, thx to the plain [property method call wrapper][16]


## Copyright

* Dominik Zogg <dominik.zogg@gmail.com>


## Contributors

* Dominik Zogg
* Patrick Landolt


[1]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/AccessorTrait.php
[2]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/Accessors/Add.php
[3]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/Accessors/Get.php
[4]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/Accessors/Is.php
[5]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/Accessors/Remove.php
[6]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/Accessors/Set.php
[7]: https://packagist.org/packages/saxulum/saxulum-accessor
[8]: https://github.com/doctrine/doctrine2
[9]: https://github.com/doctrine/mongodb-odm
[10]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/AccessorTrait.php#L28
[11]: https://github.com/symfony/PropertyAccess
[12]: https://github.com/symfony/Form
[13]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/AccessorTrait.php#L40
[14]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/AccessorTrait.php#L53
[15]: http://twig.sensiolabs.org
[16]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/AccessorTrait.php#L71