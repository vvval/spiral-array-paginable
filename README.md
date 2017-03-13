# spiral-array-paginable

Small helper, that grants ability to paginate arrays in RecordSource way. Created for [Spiral Framework](https://github.com/spiral)

## Usage
```php
//Example input data
$data = [
    'one'   => 10,
    'two'   => 20,
    'three' => 30,
    'four'  => 40,
    'five'  => 50,
    'six'   => 60,
    'seven' => 70,
    'eight' => 80,
    'nine'  => 90,
    'ten'   => 100,
];

$paginable = new PaginableArray($data);
$paginable->paginate(5);

//Implements `\Iterator` so you can just use it in foreach cycle
foreach ($paginable as $value) {
    echo $value; // 10, 20, 30, 40, 50 for first page
}

//Also preserves keys. To access them during foreach cycle use `iterate()` method
foreach ($paginable->iterate() as $key => $value) {
    echo $key; // one, two, three, four, five for first page
}
```