<?php

namespace Adshares\Ads\Entity;

/**
 * Base class for response entities.
 *
 * @package Adshares\Ads\Entity
 */
abstract class AbstractEntity implements EntityInterface
{

    protected function fillWithData(array $data): void
    {
        foreach ($data as $key => $value) {
            $key = $this->toCamelCase($key);
            if (property_exists($this, $key)) {
                $this->key = $value;
            }
        }
    }

    /**
     *
     * @param  string $type
     * @param  mixed $value
     * @return mixed
     */
    protected static function convertType(string $type, $value)
    {
        switch ($type) {
            case 'bool':
            case 'boolean':
                $value = (bool)$value;
                break;
            case 'int':
            case 'integer':
                $value = (int)$value;
                break;
            case 'float':
            case 'double':
                $value = (float)$value;
                break;
            case 'string':
                break;
            case '\DateTime':
                $value = is_numeric($value) ? new \DateTime("@$value") : new \DateTime($value);
                break;
            default:
                if (preg_match('/array\[([^\s]+)\]/', $type, $matches)) {
                    list(, $t) = $matches;
                    foreach ((array)$value as $k => $v) {
                        $value[$k] = self::convertType($t, $v);
                    }
                    break;
                }
                $entityType = 'Adshares\Ads\Entity\\' . $type;
                if (class_exists($entityType)) {
                    $type = $entityType;
                }
                if (class_exists($type)) {
                    $interfaces = class_implements($type);

                    if (isset($interfaces['Adshares\Ads\Entity\EntityInterface'])) {
                        $value = $type::createFromRaw($value);
                    }
                    break;
                }
        }

        return $value;
    }

    public static function createFromRaw(array $data): EntityInterface
    {
        $entity = new static();
        try {
            $refClass = new \ReflectionClass($entity);
        } catch (\ReflectionException $e) {
            $refClass = null;
        }

        foreach ($data as $key => $value) {
            $name = ucwords(str_replace('_', ' ', $key));
            $name = str_replace(' ', '', $name);
            $name[0] = strtolower($name[0]);

            if (property_exists($entity, $name)) {
                $entity->$name = static::castProperty($name, $value, $refClass);
            }
        }

        return $entity;
    }

    /**
     *
     * @param  string           $name
     * @param  mixed            $value
     * @param  \ReflectionClass $refClass
     * @return mixed
     */
    protected static function castProperty(string $name, $value, \ReflectionClass $refClass = null)
    {
        if (null !== $refClass) {
            $comment = $refClass->getProperty($name)->getDocComment();
            $matches = [];
            if (preg_match('/@var\s+([^\s]+)/', $comment, $matches)) {
                $types = explode('|', $matches[1]);
                $type = array_shift($types);
                if ('null' == $type) {
                    $type = array_shift($types);
                }
                $value = self::convertType($type, $value);
            }
        }

        return $value;
    }

    /**
     * Changes string with underscores to camelCase string. First letter is low.
     *
     * @param  string $text text to change case
     * @return string text in camelCase
     */
    private function toCamelCase(string $text): string
    {
        if (strpos($text, "_") !== false) {
            $text = str_replace(' ', '', ucwords(str_replace('_', ' ', $text)));
        }
        $text[0] = strtolower($text[0]);
        return $text;
    }
}
