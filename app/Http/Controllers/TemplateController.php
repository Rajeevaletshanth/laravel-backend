<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\TemplateRepository;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    protected $templateRepository;

    public function __construct(TemplateRepository $templateRepository)
    {
        $this->templateRepository = $templateRepository;
    }

    public function index()
    {
        try {
            return $this->templateRepository->getAll();
        } catch (\Throwable $th) {
            return response()->json(['response' => 'error']);
        }
    }

    public function addNewData(Request $request){
        try {
            return $this->templateRepository->addData($request->data);
        } catch (\Throwable $th) {
            return response()->json(['response' => 'error']);
        }
    }

    public function findbyId($id){
        try {
            return $this->templateRepository->findbyId($id);
        } catch (\Throwable $th) {
            return response()->json(['response' => 'error']);
        }
    }

    public function deleteData($id){
        try {
            return $this->templateRepository->deleteData($id);
        } catch (\Throwable $th) {
            return response()->json(['response' => 'error']);
        }
    }

    public function generatePdf(Request $request){
        try {
            return $this->templateRepository->generatePdf($request);
        } catch (\Throwable $th) {
            return response()->json(['response' => 'error']);
        }
    }
}
