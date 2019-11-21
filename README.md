
#laravel-list-value

laravel 5.5

Library for manipulating arrays in Laravel


## Setting

1. composer install.
2. php artisan vendor:publish
3. config/app.php edit.

````
'providers' => [
    .
    .
    CreaMukai\LaravelListValue\Providers\ListValueServiceProvider::class
];


'aliases' => [
    .
    .
    'ListValueService' => CreaMukai\LaravelListValue\Facades\ListValueFacade::class
];

````

## How to use

````
\ListValueService::list('gender')

array:2 [▼
  1 => "male"
  2 => "female"
]
````
````
\ListValueService::valueFromKey('foo.moga', 'key3')

"value3"
````

## Make array values

1. copy App\Model\ListValue\Foo to 
2. Foo::LIST_VALUES  change

````

App\Model\ListValue\Foo
=> \ListValueService::list('foo')

App\Model\ListValue\Example\Model
=> \ListValueService::list('example.model')

````


## Methods

|Method|Content|
|---|---|
|\ListValueService::list($name)|Get list value.|
|\ListValueService::flipList($name)|Get value => key list.|
|\ListValueService::keys($name)|Get keys array.|
|\ListValueService::valueFromKey($name, $key)|Exchange key to value.|
|\ListValueService::keyFromValue($name, $value)|Exchange value to key.|
|\ListValueService::firstKey($name)|Get first key.|
|\ListValueService::lastKey($name)|Get last key.|
|\ListValueService::firstValue($name)|Get first value.|
|\ListValueService::lastValue($name)|Get last value.|


