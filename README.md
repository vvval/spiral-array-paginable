# spiral-array-paginable

Small helper, that grants ability to paginate arrays in RecordSource way. Created for [Spiral Framework](https://github.com/spiral)

[![Latest Stable Version](https://poser.pugx.org/vvval/spiral-array-paginable/v/stable)](https://packagist.org/packages/vvval/spiral-array-paginable)
[![Total Downloads](https://poser.pugx.org/vvval/spiral-array-paginable/downloads)](https://packagist.org/packages/vvval/spiral-array-paginable) 
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/vvval/spiral-array-paginable/badges/quality-score.png)](https://scrutinizer-ci.com/g/vvval/spiral-array-paginable/) 
[![Coverage Status](https://coveralls.io/repos/github/vvval/spiral-array-paginable/badge.svg)](https://coveralls.io/github/vvval/spiral-array-paginable)
[![Build Status](https://travis-ci.org/vvval/spiral-array-paginable.svg?branch=master)](https://travis-ci.org/vvval/spiral-array-paginable)

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