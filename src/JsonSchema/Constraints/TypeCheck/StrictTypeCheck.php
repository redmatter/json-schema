<?php

namespace JsonSchema\Constraints\TypeCheck;

class StrictTypeCheck implements TypeCheckInterface
{
    public static function isObject($value)
    {
        return is_object($value);
    }

    public static function isArray($value)
    {
        return is_array($value);
    }

    public static function propertyGet($value, $property)
    {
        if (is_array($value)) {
            return $value[$property];
        }

        return $value->{$property};
    }

    public static function propertySet(&$value, $property, $data)
    {
        if (is_array($value)) {
            $value[$property] = $data;
        } else {
            $value->{$property} = $data;
        }
    }

    public static function propertyExists($value, $property)
    {
        if (is_array($value)) {
            return array_key_exists($property, $value);
        }

        return property_exists($value, $property);
    }

    public static function propertyCount($value)
    {
        if (is_array($value)) {
            return count($value);
        }

        return count(get_object_vars($value));
    }
}
