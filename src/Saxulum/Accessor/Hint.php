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
        return self::validateScalarValue('is_bool', $value, $nullable);
    }

    /**
     * @param  mixed     $value
     * @param  bool|null $nullable
     * @return bool
     */
    public static function validateInt($value, $nullable = null)
    {
        return self::validateScalarValue('is_int', $value, $nullable);
    }

    /**
     * @param  mixed     $value
     * @param  bool|null $nullable
     * @return bool
     */
    public static function validateFloat($value, $nullable = null)
    {
        return self::validateScalarValue('is_float', $value, $nullable);
    }

    /**
     * @param  mixed     $value
     * @param  bool|null $nullable
     * @return bool
     */
    public static function validateString($value, $nullable = null)
    {
        return self::validateScalarValue('is_string', $value, $nullable);
    }

    /**
     * @param  string    $method
     * @param  string    $value
     * @param  bool|null $nullable
     * @return bool
     */
    protected static function validateScalarValue($method, $value, $nullable = null)
    {
        if (null === $nullable) {
            $nullable = true;
        }

        if (true === $nullable && null === $value) {
            return true;
        }

        return $method($value);
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
