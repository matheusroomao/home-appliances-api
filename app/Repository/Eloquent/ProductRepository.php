<?php

namespace App\Repository\Eloquent;

use App\Models\Product;
use App\Repository\Contracts\ProductInterface;

class ProductRepository extends AbstractRepository implements ProductInterface
{
  protected $model = Product::class;
  private $message;
  private $relationships = ['brand'];
  private $dependencies = [];

  public function __construct()
  {
    $this->model = app($this->model);
    parent::__construct($this->model, $this->message ,$this->relationships, $this->dependencies);
  }
}