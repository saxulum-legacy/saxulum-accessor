<?php

namespace Saxulum\Accessor;

trait AccessorRegistry
{
    /**
     * @var AccessorInterface[]
     */
    private static $__accessors = array();

    final public static function registerAccessor(AccessorInterface $accessor)
    {
        $prefix = $accessor->getPrefix();

        if (isset(self::$__accessors[$prefix])) {
            throw new \Exception("Override Accessor is not allowed, to enhance stability!");
        }

        self::$__accessors[$prefix] = $accessor;
    }

    /**
     * @return AccessorInterface[]
     */
    final public static function getAccessors()
    {
        return self::$__accessors;
    }
}
