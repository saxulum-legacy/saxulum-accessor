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
            return static::$method($value, $nullable);
        }

        return static::validateObject($value, $hint, $nullable);
    }

    /**
     * @param  mixed     $value
     * @param  bool|null $nullable
     * @return bool
     */
    public static function validateBool($value, $nullable = null)
    {
        if (null === $nullable) {
            $nullable = true;
        }

        if (true === $nullable && null === $value) {
            return true;
        }

        return is_bool($value);
    }

    /**
     * @param  mixed     $value
     * @param  bool|null $nullable
     * @return bool
     */
    public static function validateInt($value, $nullable = null)
    {
        if (null === $nullable) {
            $nullable = true;
        }

        if (true === $nullable && null === $value) {
            return true;
        }

        return is_int($value);
    }

    /**
     * @param  mixed     $value
     * @param  bool|null $nullable
     * @return bool
     */
    public static function validateFloat($value, $nullable = null)
    {
        if (null === $nullable) {
            $nullable = true;
        }

        if (true === $nullable && null === $value) {
            return true;
        }

        return is_float($value);
    }

    /**
     * @param  mixed     $value
     * @param  bool|null $nullable
     * @return bool
     */
    public static function validateString($value, $nullable = null)
    {
        if (null === $nullable) {
            $nullable = true;
        }

        if (true === $nullable && null === $value) {
            return true;
        }

        return is_string($value);
    }

    /**
     * @param  mixed     $value
     * @param  bool|null $nullable
     * @return bool
     */
    public static function validateArray($value, $nullable = null)
    {
        if (null === $nullable) {
            $nullable = false;
        }

        if (true === $nullable && null === $value) {
            return true;
        }

        return is_array($value);
    }

    /**
     * @param  mixed     $value
     * @param  string    $hint
     * @param  bool|null $nullable
     * @return bool
     */
    public static function validateObject($value, $hint, $nullable = null)
    {
        if (null === $nullable) {
            $nullable = false;
        }

        if (true === $nullable && null === $value) {
            return true;
        }

        return is_object($value) && is_a($value, $hint);
    }
}
