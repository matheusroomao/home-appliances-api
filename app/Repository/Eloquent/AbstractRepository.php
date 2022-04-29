<?php

namespace App\Repository\Eloquent;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use stdClass;

abstract class AbstractRepository {

    private $model;
    private $message;
    private $relationships = [];
    private $dependencies;

    public function __construct($model, $message, $relationships, $dependencies) {
        $this->model = $model;
        $this->message = new stdClass();
        $this->relationships = $relationships;
        $this->dependencies = $dependencies;
    }

    public function all(Request $request) {
        try {
            $models = $this->model->query()->with($this->relationships);
            if (!empty($request->input('search'))) {
                $this->filterGlobal($request, $models);
            } else {
                $this->filterByColumn($request, $models);
            }
            $models = $this->ordenate($request, $models);
            $this->setMessage($models['total'] . " recurso(s) encontrado(s)", 200);
            return $models;
        } catch (Exception $e) {
            $this->setMessage('Erro encontrado com o código ' . $e->getMessage(), 500);
        }
        return null;
    }

    public function create(Request $request) {
        try {
            $model = new $this->model();
            $model->fill($request->all());
            
            $model->save();
            $this->setMessage("Salvo com sucesso", 201);
            return $model;
        } catch (Exception $e) {
            $this->setMessage('Erro encontrado com o código ' . $e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $model = $this->model->find($id);
            if (!empty($model)) {
                $model->fill($request->all());
                
                $model->save();
                $this->setMessage('Atualizado com sucesso', 200);
                return $model;
            }
            $this->setMessage("Recurso não encontrado", 404);
        } catch (Exception $e) {
            $this->setMessage('Erro encontrado com o código ' . $e->getMessage(), 500);
        }
        return null;
    }

    public function findById($id) {
        try {
            $model = $this->model->find($id);
            if (!empty($model)) {
                $this->setMessage("Recurso encontrado", 200);
                return $model;
            }
            $this->setMessage("Recurso não encontrado", 404);
        } catch (Exception $e) {
            $this->setMessage('Erro encontrado com o código ' . $e->getMessage(), 500);
        }
        return null;
    }

    public function delete($id)
    {  
        $model = $this->model->query()->with($this->relationships);
        $model = $model->find($id);
        if (empty($model)) {
            $this->setMessage("Registro não encontrado", 404);
            return null;
        }
        if ($this->dependencies($model) == false) {
            $this->setMessage('O registro não pode ser apagado, o mesmo está vinculado em outro lugar.', 422);
            return null;
        }
        $model->destroy($model->id);
        $this->setMessage('O registro foi apagado com sucesso.',200);
        return null;
    }

    protected function filterGlobal(Request $request, $search) {
        if ($field = $request->input('search')) {
            $columns = Schema::getColumnListing($this->model->getTable());
            foreach ($columns as $column) {
                $search->orWhere($column, "LIKE", "%" . $field . "%");
            }
        }
    }

    protected function filterByColumn(Request $request, $search) {
        $columns = Schema::getColumnListing($this->model->getTable());
        foreach ($columns as $field) {
            if ($request->exists($field) == true) {
                $column = Schema::getColumnType($this->model->getTable(), $field);
                if ($column == "string" || $column == "datetime") {
                    $search->where($field, 'like', '%' . $request->$field . '%');
                } else{
                    $search->where($field, $request->$field);
                }
            }
        }
    }

    protected function ordenate(Request $request, $search) {
        $orderBy = $request->order_by;
        $order = $request->order;
        if (empty($orderBy) || $orderBy == null) {
            $orderBy = 'id';
        }
        if (empty($order) || $order == null) {
            $order = 'desc';
        }
        if (Schema::hasColumn($this->model->getTable(), $orderBy) == false) {
            $orderBy = 'id';
        }
        return $search->orderBy($orderBy, $order)->paginate(15);
    }

    public function getMessage() {
        return $this->message;
    }
    
    protected function dependencies($model): bool
    {
        $count = 0;
        if (!empty($model = $this->model->with($this->dependencies)->find($model->id))) {
            foreach ($this->dependencies as $dependence) {
                if (!empty($model->$dependence[0])) {
                    $count++;
                }
            }
        }
        if ($count > 0) {
            return false;
        }
        return true;
    }
    public function setMessage($text, $code) {
        $this->message->text = $text;
        $this->message->code = $code;
    }
}
