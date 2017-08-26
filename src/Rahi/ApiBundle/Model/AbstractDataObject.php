<?php


namespace Rahi\ApiBundle\Model;


abstract class AbstractDataObject implements \JsonSerializable
{
    public function getFields()
    {
        $reflectionClass = new \ReflectionClass($this);
        $properties = $reflectionClass->getProperties(\ReflectionProperty::IS_PUBLIC);

        $fields = [];
        foreach ($properties as $reflectionProperty) {
            $fields[] = $reflectionProperty->getName();
        }
        return $fields;
    }

    public function setFromArray(array $fields, array $data)
    {
        $reflectionClass = new \ReflectionClass($this);

        foreach ($fields as $field) {
            if (!isset($data[$field])) {
                continue;
            }
            if (!$reflectionClass->hasProperty($field)) {
                continue;
            }

            $reflectionProperty = $reflectionClass->getProperty($field);
            $reflectionProperty->setValue($this, $data[$field]);
        }
        return $this;
    }

    public function toArray(array $fields = [])
    {
        $reflectionClass = new \ReflectionClass($this);

        if (empty($fields)) {
            $fields = $this->getFields();
        }

        $data = [];

        foreach ($fields as $field) {
            if (!$reflectionClass->hasProperty($field)) {
                continue;
            }

            $reflectionProperty = $reflectionClass->getProperty($field);
            $data[$field] = $reflectionProperty->getValue($this);
        }

        return $data;
    }

    function jsonSerialize()
    {
        return $this->toArray();
    }
}