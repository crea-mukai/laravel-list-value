<?php

namespace App\Services;

use CreaMukai\LaravelListValue\Services\CoreListValueService;

/**
 * ListValue を使用するためService化
 * Facadesを通してAppServiceProviderに登録
 * staticで呼び出して関数使用可能
 *
 * const LIST_VALUES = [] が 必須
 * メソッドは必ずlist()を通す
 * 特殊な値セットはlist()を継承して、$nameで分岐して上書く
 *
 * \ListValueService::valueFromKey('gender', 2)
 */
class ListValueService extends CoreListValueService
{
    const LIST_VALUES = [

        // example
        'person.favorite' => [
            1 => 'Ironman',
            2 => 'Captain',
            3 => 'Thor',
        ],
    ];

    // モデル置き場
    // TODO:
    const MODEL_NAMESPACE = 'App\\Model\\ListValue\\';
    //    const MODEL_NAMESPACE = 'App\\Model\\';
    //    const MODEL_NAMESPACE = 'App\\ListValue\\';


    public static function getModelNamespace()
    {
        // return config('list_value.model_namespace');
        return self::MODEL_NAMESPACE;
    }

    /**
     * \ListValueService::list('join.win') の形で使用する。
     * 値はすべて単体モデルに分ける
     *
     * @param $name
     * @param $option
     * @return mixed
     */
    public function list($name, $option = null)
    {
        // example
        if ('age' == $name) {
            // [, 1 => 1, 2 => 2, 3 => 3,.... 100 => 100]
            $start = 1;
            $end = 100;
            return array_combine(range($start, $end), range($start, $end));
        }

        return parent::list($name, $option);
    }


    /*
    public function valueFromKey($name, $key, $option = null)
    {
        $map = static::list($name, $option);
        if (isset($map[$key])) {
            return $map[$key];
        }
    }
    */

}
