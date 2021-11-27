<?php

namespace App\Repositories\Repository;

use Exception;
use Illuminate\Http\Request;
use stdClass;

abstract class AbstractRepository
{ 

    private $model;
    private $message;
    private $relationships = [];
    private $dependents = [];

    public function __construct($model, $message, $relationships, $dependents)
    {
        $this->model = $model;
        $this->message = new stdClass();
        $this->relationships = $relationships;
        $this->dependents = $dependents;
    }

    public function read(Request $request)
    {
        try {
            $models = $this->model->paginate();

            if ($models == null) {
                $this->setMessage("recurso(s) não encontrado(s)", 404);
                return $models;
            }
            $this->setMessage("recurso(s) encontrado(s)", 200);
            return $models;
        } catch (Exception $e) {
            $this->setMessage('Erro encontrado com o código ' . $e->getMessage(), 500);
            return null;
        }
    }

    public function create(Request $request)
    {
        try {
            $model = new $this->model();
            $model->fill($request->all());
            $model->save();
            $this->setMessage("Salvo com sucesso", 201);
            return $model;
        } catch (Exception $e) {
            $this->setMessage('Erro encontrado com o código ' . $e->getMessage(), 500);
            return null;
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $model = $this->model->find($id);
            if (!empty($model)) {
                $model->fill($request->all());
                $model->save();
                $this->setMessage('Atualizado com sucesso', 200);
                return $model;
            }
            $this->setMessage("Recurso não encontrado", 404);
            return null;
        } catch (Exception $e) {
            $this->setMessage('Erro encontrado com o código ' . $e->getMessage(), 500);
            return null;
        }
    }


    public function findById($id)
    {
        try {
            $model = $this->model->with($this->relationships)->find($id);
            if (empty($model)) {
                $this->setMessage("Recurso não encontrado", 404);
                return null;
            }
            $this->setMessage("Recurso encontrado", 200);
            return $model;
        } catch (Exception $e) {
            $this->setMessage('Erro encontrado com o código ' . $e->getMessage(), 500);
            return null;
        }
    }


    public function delete($id)
    {
        try {
            $model = $this->model->find($id);
            if (!empty($this->dependents)) {
                if ($this->checkRelations($id, $this->dependents) != true) {
                    if (!empty($model)) {
                        $model->delete();
                        $this->setMessage('Apagado com sucesso', 204);
                        return null;
                    }
                    $this->setMessage("O recurso não existe", 404);
                    return null;
                } else {
                    $this->checkRelations($id, $this->dependents);
                    return null;
                }
            }
            if (!empty($model)) {
                $model->delete();
                $this->setMessage('Apagado com sucesso', 204);
                return null;
            }
            $this->setMessage("O recurso não existe", 404);
            return null;
        } catch (Exception $e) {
            $this->setMessage('Erro encontrado com o código ' . $e, 500);
            return null;
        }
    }





    public function checkRelations($id, $relationships)
    {
        foreach ($relationships as $relation) {
            if (!empty($this->model->with($this->dependents)->find($id)->$relation)) {
                $relation1 = $this->model->with($this->dependents)->find($id)->$relation->first();
                if ($relation1 != null) {
                    $this->setMessage('Não é possível deletar pois existe outro registro relacionado à este em ' . $relation1->title, 403);
                    return true;
                }
            }
        }
    }


    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($text, $code)
    {
        $this->message->text = $text;
        $this->message->code = $code;
    }
}
