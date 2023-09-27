<?php

namespace App\Repositories;

use App\Models\Template;
use App\Models\TemplateController; // Replace with your actual model
use Illuminate\Support\Facades\View;
use Illuminate\Http\Response;
use Dompdf\Dompdf;
use Dompdf\Options;

class TemplateRepository
{
    public function getAll()
    {
        try {
            $allTemplates = Template::all();
            return $allTemplates;
        } catch (\Throwable $th) {
            return response()->json([
                'response' => 'error',
                'status' => $th
            ]);
        }
        
    }

    public function addData($data) {
        try {
            $add_data = Template::create([
                'data' => json_encode($data)
            ]);
            return $add_data;
        } catch (\Throwable $th) {
            return response()->json([
                'response' => 'error',
                'status' => $th
            ]);
        }
    }

    public function deleteData($id){
        try {
            $record = Template::find($id);
            if (!$record) {
                return response()->json(['message' => 'Record not found'], 404);
            }

            $record->delete();
            
            return response()->json(['message' => 'Record deleted'], 200);
            
        } catch (\Throwable $th) {
            return response()->json([
                'response' => 'error',
                'status' => $th
            ]);
        }
    }

    public function findbyId($id){
        try {
            $data = Template::find($id);

            return $data;
        } catch (\Throwable $th) {
            return response()->json([
                'response' => 'error',
                'status' => $th
            ]);
        }
    }

    public function generatePdf($request)
    {
         // Create a new Dompdf instance
         $dompdf = new Dompdf();

         // Load the Blade view into a variable
        //  $view = View::make('pdf')->with('data', $data);
         $view = View::make('pdf')->with('data', $request->data);
 
         // Convert the Blade view to HTML
         $html = $view->render();
 
         // Load the HTML content into Dompdf
         $dompdf->loadHtml($html);
 
         // Set paper size and orientation (optional)
         $options = new Options();
         $options->set('isPhpEnabled', true); // Allows embedding PHP code in the HTML
         $dompdf->setOptions($options);
 
         // Render the HTML as PDF
         $dompdf->render();
 
         // Generate the PDF content
         $pdfContent = $dompdf->output();
 
         // Create a response with the PDF content
         $response = new Response($pdfContent);
 
         // Set the response headers for PDF download
         $response->header('Content-Type', 'application/pdf');
         $response->header('Content-Disposition', 'attachment; filename="document.pdf"');
 
         return $response;
    }


}
