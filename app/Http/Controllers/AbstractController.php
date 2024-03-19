<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Dotenv\Exception\ValidationException;

abstract class AbstractController extends Controller
{
    protected $service;

    protected function __construct(object $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show(int $id)
    {
        return $this->service->show($id);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request->all());
        return $this->service->store($request->all());
    }

    public function update(Request $request, int $id)
    {
        $this->validateRequest($request->all());
        return $this->service->update($request->all(), $id);
    }

    public function destroy(int $id)
    {
        return $this->service->destroy($id);
    }

    protected function validateRequest($data)
    {

        $rules = $this->getFormRequest()->rules();
    
        $messages = $this->getFormRequest()->messages();
    
        $validator = Validator::make($data, $rules, $messages);
    
        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->toJson());
        }
    }

    abstract protected function getFormRequest();   
}
