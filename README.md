saxulum-accessor
================

[![Build Status](https://api.travis-ci.org/saxulum/saxulum-accessor.png?branch=master)](https://travis-ci.org/saxulum/saxulum-accessor)
[![Total Downloads](https://poser.pugx.org/saxulum/saxulum-accessor/downloads.png)](https://packagist.org/packages/saxulum/saxulum-accessor)
[![Latest Stable Version](https://poser.pugx.org/saxulum/saxulum-accessor/v/stable.png)](https://packagist.org/packages/saxulum/saxulum-accessor)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/saxulum/saxulum-accessor/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/saxulum/saxulum-accessor/?branch=master)

Features
--------

 * Contains a [accessor trait][1] which allows to register accessors
 * Contains a [getter accessor][2], which means you don't have to write simple getters anymore
 * Contains a [is accessor][3], which means you don't have to write simple is anymore
 * Contains a [setter accessor][4], which means you don't have to write simple setters anymore

Requirements
------------

 * PHP 5.4+

Installation
------------

Through [Composer](http://getcomposer.org) as [saxulum/accessor][5].

Usage
-----

If you like to allow getter/is/setter on all properties:

``` {.php}
/**
 * @method $this setName(string $name)
 * @method string getName()
 * @method boolean isName()
 * @method $this setValue(string $value)
 * @method string getValue()
 * @method boolean isValue()
 */
class MyObject
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
            ->addAccessor(new GetterAccessor())
            ->addAccessor(new IsAccessor())
            ->addAccessor(new SetterAccessor())
        ;
    }
}

$object = new MyObject();
$object
    ->setName('name')
    ->setValue('value')
;

$object->getName();
$object->getValue();

$object->isName();
$object->isValue();
```

If you like to whitelist getter/is/setter for property `name`:

``` {.php}
/**
 * @method $this setName(string $name)
 * @method string getName()
 * @method boolean isName()
 */
class MyObject
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
            ->addAccessor((new GetterAccessor())->properties(array('name')))
            ->addAccessor((new IsAccessor())->properties(array('name')))
            ->addAccessor((new SetterAccessor())->properties(array('name')))
        ;
    }
}

$object = new MyObject();

$object->setName('name');
$object->getName();
$object->isName();
```

If you like to blacklist getter/is/setter for property `value`:

``` {.php}
/**
 * @method $this setName(string $name)
 * @method string getName()
 * @method boolean isName()
 */
class MyObject
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
                ->properties(array('value'))
                ->mode(AbstractAccessor::MODE_BLACKLIST)
            )
            ->addAccessor((new IsAccessor())
                ->properties(array('value'))
                ->mode(AbstractAccessor::MODE_BLACKLIST)
            )
            ->addAccessor((new SetterAccessor())
                ->properties(array('value'))
                ->mode(AbstractAccessor::MODE_BLACKLIST)
            )
        ;
    }
}

$object = new MyObject();

$object->setName('name');
$object->getName();
$object->isName();
```

Arguments
---------

Pros:

- less code to write
- less code to debug
- clearer

Cons:

- no autogeneration of `@method` phpdoc
- slower (no benchmark)
- more complex
- `method_exists` does not work, use `is_callable` instead, which is better, cause it depends on access rights, which `method_exists` doesn't


Copyright
---------
* Dominik Zogg <dominik.zogg@gmail.com>


Contributors
------------
* Dominik Zogg
* Patrick Landolt


[1]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/AccessorTrait.php
[2]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/Accessors/GetterAccessor.php
[3]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/Accessors/IsAccessor.php
[4]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/Accessors/SetterAccessor.php
[5]: https://github.com/saxulum/saxulum-accessor
