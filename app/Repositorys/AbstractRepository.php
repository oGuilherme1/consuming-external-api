<?php

namespace App\Repositorys;

abstract class AbstractRepository
{

    protected $model;

    protected function __construct(object $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        try {
            return $this->model::all();
        }
        catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }

    }

    public function find(int $id)
    {   
        try{
            return $this->model::find($id);
        }
        catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }

    }

    public function create(array $data)
    {
        try{
            $this->model::create($data);
            return response()->json(["message" => "created successfully"], 200);
        }
        catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }

    }

    public function update(array $data, int $id)
    {
        try{
            $this->model::where("id", $id)->update($data);
            return response()->json(["message" => "updated successfully"], 200);
        }
        catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }

    }

    public function delete(int $id)
    {
        try{
            $this->model::where("id", $id)->delete();
            return response()->json(["message" => "deleted successfully"], 200);
        }
        catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }

    }

    
}