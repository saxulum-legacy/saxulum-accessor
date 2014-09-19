<?php

namespace Saxulum\Accessor;

class Hint
{
    const HINT_STR = 'string';
    const HINT_INT = 'int';
    const HINT_FLOAT = 'float';
    const HINT_BOOL = 'bool';
    const HINT_ARRAY = 'array';

    /**
     * @param $property
     * @param  null $hint
     * @param  bool $nullable
     * @return bool
     */
    public static function validate($property, $hint = null, $nullable = true)
    {
        switch ($hint) {
            case null:
                return true;
            case self::HINT_STR:
            case self::HINT_INT:
            case self::HINT_FLOAT:
            case self::HINT_BOOL:
            case self::HINT_ARRAY:
                if (null === $property && true === $nullable) {
                    return true;
                }

                return call_user_func('is_' . $hint, $property);
            default:
                if (null === $property && true === $nullable) {
                    return true;
                }

                return is_object($property) && is_a($property, $hint);
        }
    }
}
