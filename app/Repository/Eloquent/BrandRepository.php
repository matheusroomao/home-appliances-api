<?php

namespace App\Repository\Eloquent;

use App\Models\Brand;
use App\Repository\Contracts\BrandInterface;

class BrandRepository extends AbstractRepository implements BrandInterface
{
  protected $model = Brand::class;
  private $message;
  private $relationships = ['products'];
  private $dependencies = ['products'];

  public function __construct()
  {
    $this->model = app($this->model);
    parent::__construct($this->model, $this->message, $this->relationships, $this->dependencies);
  }
}
