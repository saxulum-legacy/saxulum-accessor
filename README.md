saxulum-accessor
================

[![Build Status](https://api.travis-ci.org/saxulum/saxulum-accessor.png?branch=master)](https://travis-ci.org/saxulum/saxulum-accessor)
[![Total Downloads](https://poser.pugx.org/saxulum/saxulum-accessor/downloads.png)](https://packagist.org/packages/saxulum/saxulum-accessor)
[![Latest Stable Version](https://poser.pugx.org/saxulum/saxulum-accessor/v/stable.png)](https://packagist.org/packages/saxulum/saxulum-accessor)

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
        $this->addAccessor(new GetterAccessor());
        $this->addAccessor(new IsAccessor());
        $this->addAccessor(new SetterAccessor());
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

Copyright
---------
* Dominik Zogg <dominik.zogg@gmail.com>


[1]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/AccessorTrait.php
[2]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/Accessors/GetterAccessor.php
[3]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/Accessors/IsAccessor.php
[4]: https://github.com/saxulum/saxulum-accessor/blob/master/src/Saxulum/Accessor/Accessors/SetterAccessor.php
[5]: https://github.com/saxulum/saxulum-accessor
