<?php

namespace CreaMukai\LaravelListValue\Services;

/**
 * ListValue を使用するためService化
 * Facadesを通してAppServiceProviderに登録
 * staticで呼び出して関数使用可能
 *
 * const LIST_VALUES = [] が 必須
 * メソッドは必ずlist()を通す
 * 特殊な値セットはlist()を継承して、$nameで分岐して上書く
 *
 * \ListValueService::valueFromKey('join.gender', 2)
 */
class CoreListValueService
{

    // モデル置き場
    // const MODEL_NAMESPACE = 'App\\Model\\ListValue\\';
//    const MODEL_NAMESPACE = 'App\\Model\\';

    // public static function getModelNamespace()
    // {
    //     return config('list_value.model_namespace');
    // }


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
        // static::MODEL_NAMESPACE にあれば使用
        if (!isset(static::LIST_VALUES[$name])) {

            $className = static::getModelNamespace() . $this->dotKey2ModelColumn($name);

            if (class_exists($className)) {
                if (null != $className::LIST_VALUES) {
                    return $className::LIST_VALUES;
                }
            }
        }

        // ListValueService::LIST_VALUES
        return static::LIST_VALUES[$name];
    }


    /**
     * 自動でListValueを読み込むため、
     * join.adddress_city -> Join/AddressOsaka
     * に変換する
     *
     * @param $string
     * @return string
     */
    protected function dotKey2ModelColumn($string)
    {
        $values = explode('.', $string);
        $values = array_map(function($value){
            return studly_case($value);
            }
            , $values
        );

        return implode('\\', $values);
    }


    /**
     * @return mixed
     */
    //    public function __invoke()
    //    {
    //        return static::list($name);
    //    }

    /**
     * キーと値を入れ替えたリストを返す
     * @param $name
     * @param $option
     * @return array|null
     */
    public function flipList($name, $option = null)
    {
        return array_flip(static::list($name, $option));
    }

    /**
     * キー一覧取得
     * @param $name
     * @param $option
     * @return array
     */
    public function keys($name, $option = null)
    {
        $keys = array_keys(static::list($name, $option));

        return $keys;
    }

    /**
     * キーから値を取得
     *
     * @param $name
     * @param $key
     * @param $option
     * @return String
     */
    public function valueFromKey($name, $key, $option = null)
    {
        $map = static::list($name, $option);
        if (isset($map[$key])) {
            return $map[$key];
        }
    }


    /**
     * 値からキーを取得
     *
     * @param $name
     * @param $value
     * @param $option
     * @return mixed
     */
    public function keyFromValue($name, $value, $option = null)
    {
        $map = static::list($name, $option);
        $map = array_flip($map);
        if (isset($map[$value])) {
            return $map[$value];
        }
    }

    /**
     * 最初のキーを取得
     * @param $name
     * @param $option
     * @return int|null|string
     */
    public function firstKey($name, $option = null)
    {
        $map = static::list($name, $option);
        reset($map);
        return key($map);
    }

    /**
     * 最後のキーを取得
     * @param $name
     * @param $option
     * @return int|null|string
     */
    public function lastKey($name, $option = null)
    {
        $map = static::list($name, $option);
        end($map);
        return key($map);
    }

    /**
     * 最初の値を取得
     * @param $name
     * @param $option
     * @return int|null|string
     */
    public function firstValue($name, $option = null)
    {
        $map = static::list($name, $option);
        return reset($map);
    }

    /**
     * 最後の値を取得
     * @param $name
     * @param $option
     * @return int|null|string
     */
    public function lastValue($name, $option = null)
    {
        $map = static::list($name, $option);
        return end($map);
    }

}
