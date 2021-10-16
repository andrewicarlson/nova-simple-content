<?php

namespace Tests;

class Support
{
    public static function testColumns($columns, $context)
    {
        foreach ($columns as $column) {
            $doctrine_column = $column['column'];

            $context->assertEquals($column['type'], $doctrine_column->getType()->getName(), "{$doctrine_column->getName()} is type: {$column['type']}");

            if ($column['nullable'] === false) {
                $context->assertTrue($doctrine_column->getNotnull(), "{$doctrine_column->getName()} is not nullable");
            } else {
                $context->assertFalse($doctrine_column->getNotnull(), "{$doctrine_column->getName()} is nullable");
            }

            if (isset($column['defaultValue'])) {
                $context->assertEquals($column['defaultValue'], $doctrine_column->getDefault(), "{$doctrine_column->getName()} has default value {$column['defaultValue']}");
            }
        }
    }
}
