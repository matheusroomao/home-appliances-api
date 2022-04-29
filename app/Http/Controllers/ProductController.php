<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Repository\Contracts\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, ProductInterface $interface)
    {
        return response()->json(["models" => $interface->all($request), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function store(ProductRequest $request, ProductInterface $interface)
    {
        return response()->json(["model" => $interface->create($request), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function show($id, ProductInterface $interface)
    {
        return response()->json(["model" => $interface->findById($id), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function update(ProductRequest $request, $id, ProductInterface $interface)
    {
        return response()->json(["model" => $interface->update($request, $id), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function destroy($id, ProductInterface $interface)
    {
        return response()->json(["model" => $interface->delete($id), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }
}
