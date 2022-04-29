<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Repository\Contracts\BrandInterface;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request, BrandInterface $interface)
    {
        return response()->json(["models" => $interface->all($request), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function store(BrandRequest $request, BrandInterface $interface)
    {
        return response()->json(["model" => $interface->create($request), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function show($id, BrandInterface $interface)
    {
        return response()->json(["model" => $interface->findById($id), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function update(BrandRequest $request, $id, BrandInterface $interface)
    {
        return response()->json(["model" => $interface->update($request, $id), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function destroy($id, BrandInterface $interface)
    {
        return response()->json(["model" => $interface->delete($id), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }
}
