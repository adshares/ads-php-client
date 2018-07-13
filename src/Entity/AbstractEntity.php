<?php

namespace Adshares\Ads\Entity;

/**
 * Base class for response entities.
 *
 * @package Adshares\Ads\Entity
 */
abstract class AbstractEntity implements EntityInterface
{

    /**
     * Changes string with underscores to camelCase string. First letter is low.
     *
     * @param  string $text text to change case
     * @return string text in camelCase
     */
    private static function toCamelCase(string $text): string
    {
        if (strpos($text, "_") !== false) {
            $text = str_replace(' ', '', ucwords(str_replace('_', ' ', $text)));
        }
        $text[0] = strtolower($text[0]);

        return $text;
    }

    /**
     * @param string $type
     * @param mixed $value
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
                if (is_numeric($value)) { // unix timestamp
                    $date = new \DateTime();
                    $date->setTimestamp($value);
                    $value = $date;
                } else {
                    $value = new \DateTime($value);
                }
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
                        try {
                            /* @var $type EntityInterface*/
                            $value = EntityFactory::create((new \ReflectionClass($type))->getShortName(), $value);
                        } catch (\ReflectionException $e) {
                        }
                    }
                    break;
                }
        }

        return $value;
    }

    /**
     * @inheritdoc
     */
    protected static function castProperty(string $name, $value, \ReflectionClass $refClass = null)
    {
        if (null !== $refClass) {
            $comment = $refClass->getProperty($name)->getDocComment();
            $matches = [];
            if (preg_match('/@var\s+([^\s]+)/', (string)$comment, $matches)) {
                $types = explode('|', $matches[1]);
                $type = array_shift($types);
                if ('null' == $type) {
                    $type = array_shift($types);
                }
                $value = self::convertType((string)$type, $value);
            }
        }

        return $value;
    }

    /**
     * @param array $data
     */
    public function fillWithRawData(array $data): void
    {
        try {
            $refClass = new \ReflectionClass($this);
        } catch (\ReflectionException $e) {
            $refClass = null;
        }

        foreach ($data as $key => $value) {
            $name = self::toCamelCase($key);

            if (property_exists($this, $name)) {
                $this->$name = static::castProperty($name, $value, $refClass);
            }
        }
    }

    /**
     * @param array $data
     * @return EntityInterface
     */
    public static function createFromRawData(array $data): EntityInterface
    {
        $entity = new static();
        $entity->fillWithRawData($data);

        return $entity;
    }
}
