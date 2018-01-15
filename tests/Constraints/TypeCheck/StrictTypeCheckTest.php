<?php

namespace JsonSchema\Tests\Constraints\TypeCheck;

use JsonSchema\Constraints\TypeCheck\StrictTypeCheck;

class StrictTypeCheckTest extends \PHPUnit_Framework_TestCase
{
    public function testIsObject()
    {
        $this->assertTrue(StrictTypeCheck::isObject(new \stdClass()));
        $this->assertFalse(StrictTypeCheck::isObject('AString'));
        $this->assertFalse(StrictTypeCheck::isObject(array()));
    }

    public function testIsArray()
    {
        $this->assertFalse(StrictTypeCheck::isArray(new \stdClass()));
        $this->assertFalse(StrictTypeCheck::isArray('AString'));
        $this->assertTrue(StrictTypeCheck::isArray(array()));
    }

    public function testPropertyGet()
    {
        // Array
        $value = array('property' => 'value');
        $this->assertSame('value', StrictTypeCheck::propertyGet($value, 'property'));

        // Object
        $value = new \stdClass();
        $value->property = 'value';
        $this->assertSame('value', StrictTypeCheck::propertyGet($value, 'property'));
    }

    public function testPropertySet()
    {
        // Array
        $value = array();
        StrictTypeCheck::propertySet($value, 'property', 'value');
        $this->assertSame('value', $value['property']);

        // Object
        $value = new \stdClass();
        StrictTypeCheck::propertySet($value, 'property', 'value');
        $this->assertSame('value', $value->property);
    }

    public function testPropertyExists()
    {
        // Array
        $value = array('property' => 'value');
        $this->assertTrue(StrictTypeCheck::propertyExists($value, 'property'));
        $this->assertFalse(StrictTypeCheck::propertyExists($value, 'anotherProperty'));

        // Object
        $value = new \stdClass();
        $value->property = 'value';
        $this->assertTrue(StrictTypeCheck::propertyExists($value, 'property'));
        $this->assertFalse(StrictTypeCheck::propertyExists($value, 'anotherProperty'));
    }

    public function testPropertyCount()
    {
        // Array
        $value = array('property' => 'value', 'anotherProperty' => 'anotherValue');
        $this->assertSame(2, StrictTypeCheck::propertyCount($value));

        // Object
        $value = new \stdClass();
        $value->property = 'value';
        $value->anotherProperty = 'anotherValue';
        $this->assertSame(2, StrictTypeCheck::propertyCount($value));
    }
}
