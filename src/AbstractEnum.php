<?php

namespace KuznetsovZfort\PhpEnum;

use Illuminate\Support\Collection;

abstract class AbstractEnum extends BaseEnum
{
    /**
     * @param string $keyName
     * @param string $labelName
     *
     * @return Collection
     */
    public static function map(string $keyName = 'id', string $labelName = 'label'): Collection
    {
        return collect(static::listData())->transform(function ($item, $key) use ($keyName, $labelName) {
            return [$keyName => $key, $labelName => $item];
        })->values();
    }

    /**
     * @return array
     */
    public static function listKeys(): array
    {
        return is_array(static::$list) ? array_keys(static::$list) : [];
    }

    /**
     * @param array $keys
     *
     * @return mixed
     */
    public static function listData(array $keys = [])
    {
        if (empty($keys)) {
            return parent::listData();
        }

        $result = [];
        foreach ($keys as $key) {
            $result[$key] = self::getLabel($key);
        }

        return $result;
    }
}
