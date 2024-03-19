<?php

namespace App\Services;

abstract class AbstractService
{

    protected $repository;

    protected function __construct(object $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        return $this->repository->all();
    }

    public function show(int $id)
    {
        return $this->repository->find($id);
    }

    public function store(array $data)
    {

        return $this->repository->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->repository->update($data, $id);
    }

    public function destroy(int $id)
    {
        return $this->repository->delete($id);
    }
}