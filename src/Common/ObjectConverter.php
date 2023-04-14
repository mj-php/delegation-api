<?php

namespace Common;

use ReflectionClass;

final class ObjectConverter
{
    public static function create(int $id): self
    {
        return new self($id);
    }

    private function __construct(int $id)
    {
        $this->id = $id;
    }

    public function toArray(): array
    {
        return ObjectConverter::objectToArray($this);
    }

    static function objectToArray($obj)
    {
        if (is_object($obj)) {
            $obj = ObjectConverter::dismount($obj);
            $obj = (array)$obj;
        }

        if (is_array($obj)) {
            $newArray = array();

            foreach ($obj as $key => $val) {

                $newArray[$key] = self::objectToArray($val);
            }
        } else {
            $newArray = $obj;
        }

        return $newArray;
    }

    static function dismount($object): array
    {
        $type = get_class($object);

        if ($type == 'DateTime') {
            $array = (array)$object;
        } else {
            $reflectionClass = new ReflectionClass(get_class($object));

            $array = array();

            foreach ($reflectionClass->getProperties() as $property) {
                $property->setAccessible(true);
                $array[$property->getName()] = $property->getValue($object);
                $property->setAccessible(false);
            }
        }

        return $array;
    }
}
