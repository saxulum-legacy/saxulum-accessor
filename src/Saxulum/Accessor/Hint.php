<?php

namespace Saxulum\Accessor;

class Hint
{
    const HINT_BOOL = 'bool';
    const HINT_INT = 'int';
    const HINT_FLOAT = 'float';
    const HINT_STRING = 'string';
    const HINT_ARRAY = 'array';

    /**
     * @param  mixed       $value
     * @param  string|null $hint
     * @param  null|bool   $nullable
     * @return bool
     */
    public static function validate($value, $hint = null, $nullable = null)
    {
        if (null === $hint) {
            return true;
        }

        $method = 'validate' . ucfirst($hint);

        if (method_exists(__CLASS__, $method)) {
            if (null === $nullable) {
                return static::$method($value);
            }

            return static::$method($value, $nullable);
        }

        if (null === $nullable) {
            return static::validateObject($value, $hint);
        }

        return static::validateObject($value, $hint, $nullable);
    }

    /**
     * @param  mixed $value
     * @param  bool  $nullable
     * @return bool
     */
    public static function validateBool($value, $nullable = true)
    {
        if (true === $nullable && null === $value) {
            return true;
        }

        return is_bool($value);
    }

    /**
     * @param  mixed $value
     * @param  bool  $nullable
     * @return bool
     */
    public static function validateInt($value, $nullable = true)
    {
        if (true === $nullable && null === $value) {
            return true;
        }

        return is_int($value);
    }

    /**
     * @param  mixed $value
     * @param  bool  $nullable
     * @return bool
     */
    public static function validateFloat($value, $nullable = true)
    {
        if (true === $nullable && null === $value) {
            return true;
        }

        return is_float($value);
    }

    /**
     * @param  mixed $value
     * @param  bool  $nullable
     * @return bool
     */
    public static function validateString($value, $nullable = true)
    {
        if (true === $nullable && null === $value) {
            return true;
        }

        return is_string($value);
    }

    /**
     * @param  mixed $value
     * @param  bool  $nullable
     * @return bool
     */
    public static function validateArray($value, $nullable = false)
    {
        if (true === $nullable && null === $value) {
            return true;
        }

        return is_array($value);
    }

    /**
     * @param  mixed  $value
     * @param  string $hint
     * @param  bool   $nullable
     * @return bool
     */
    public static function validateObject($value, $hint, $nullable = false)
    {
        if (true === $nullable && null === $value) {
            return true;
        }

        return is_object($value) && is_a($value, $hint);
    }
}
