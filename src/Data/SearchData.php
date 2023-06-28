<?php

namespace App\Data;

class SearchData
{
    public array $brands = [];

    public array $models = [];

    public array $types = [];

    public int $priceMax;

    public int $priceMin;

    public int $kmMax;

    public int $kmMin;

    public $reset;
}
