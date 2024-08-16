<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use Illuminate\Http\Request;
use App\Models\Stage;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Brian2694\Toastr\Toastr as ToastrToastr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Toastr;

class StageController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $stages = Stage::all();
        return view('stages.list', compact('stages'));
    }

    // Display the grid view of stages
    public function grid()
    {
        $stages = Stage::all();
        return view('stages.grid', compact('stages'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        // Récupérer la liste des étudiants
        $etudiants = Student::all(); // Vous pouvez ajouter des conditions ou des tris ici si nécessaire

        // Récupérer la liste des partenaires
        $partenaires = Partenaire::all();

        // Retourner la vue avec les données des étudiants et des partenaires
        return view('stages.add', compact('etudiants', 'partenaires'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'theme' => 'required|string|max:255',
            'partenaire_id' => 'required|exists:partenaires,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'student_id' => 'required|exists:students,id',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // Convertir les dates en format Y-m-d
        $startDate = \DateTime::createFromFormat('d-m-Y', $request->input('start_date'))->format('Y-m-d');
        $endDate = \DateTime::createFromFormat('d-m-Y', $request->input('end_date'))->format('Y-m-d');

        // Création du stage
        $stage = new Stage();
        $stage->theme = $request->input('theme');
        $stage->partenaire_id = $request->input('partenaire_id');
        $stage->start_date = $startDate;
        $stage->end_date = $endDate;
        $stage->student_id = $request->input('student_id');
        $stage->save();

        // Envoi d'un message de succès
        Toastr::success('Ajout avec succès :)', 'Succès');
        return Redirect::route('stage.list');
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $stage = Stage::findOrFail($id);
        $etudiants = Student::all();
        $partenaires = Partenaire::all();
        return view('stages.edit', compact('stage', 'etudiants', 'partenaires'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        // var_dump($request->all());
        // exit;

        // Validation des données du formulaire
        $validator = Validator::make($request->all(), [
            'theme' => 'required|string|max:255',
            'partenaire_id' => 'required|exists:partenaires,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'student_id' => 'required|exists:students,id',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // Convertir les dates en format Y-m-d
        $startDate = \DateTime::createFromFormat('d-m-Y', $request->input('start_date'))->format('Y-m-d');
        $endDate = \DateTime::createFromFormat('d-m-Y', $request->input('end_date'))->format('Y-m-d');

        // Trouver le stage par ID
        $stage = Stage::findOrFail($id);

        // Mettre à jour les données du stage
        $stage->theme = $request->input('theme');
        $stage->partenaire_id = $request->input('partenaire_id');
        $stage->start_date = $startDate;
        $stage->end_date = $endDate;
        $stage->student_id = $request->input('student_id');
        $stage->save();

        // Envoi d'un message de succès
        Toastr::success('Stage mis à jour avec succès!', 'Succès');
        return redirect()->route('stage.list');
    }


    // Remove the specified resource from storage.
    public function destroy(Request $request)
    {
        // Valider que l'ID est présent dans la requête
        $request->validate([
            'id' => 'required|exists:stages,id',
        ]);

        // Trouver le stage par ID
        $stage = Stage::findOrFail($request->input('id'));

        // Supprimer le stage
        $stage->delete();

        // Retourner avec un message de succès pour Toastr via la session
        Toastr::success('Stage supprimé avec succès.', 'Succès');
        return redirect()->route('stage.list');
    }


    public function generatePdf($stageId)
    {
        try {
            // Fetch the stage with related student and partenaire
            $stage = Stage::with('student', 'partenaire')->findOrFail($stageId);

            // Generate the PDF
            $pdf = Pdf::loadView('pdf.stage', compact('stage'))
            ->setOption('encoding', 'UTF-8');

            // Return the generated PDF for download
            return $pdf->download('stage_info.pdf');
        } catch (\Exception $e) {
            // Handle the exception and log the error
            var_dump($e->getMessage());exit;
            \Log::error('Error generating PDF: ' . $e->getMessage());

            // Optionally, you can return a response to the user
            return response()->json(['error' => 'An error occurred while generating the PDF.'], 500);
        }
    }

    public function downloadPdf()
    {
        try {
            // Fetch all stages with related student and partenaire
            $stages = Stage::with('student', 'partenaire')->get();

            // Generate the PDF
            $pdf =Pdf::loadView('pdf.stage_list', compact('stages'))
            ->setOption('encoding', 'UTF-8');

            // Return the generated PDF for download
            return $pdf->download('stages_list.pdf');
        } catch (\Exception $e) {
            // Handle the exception and log the error
            \Log::error('Error generating PDF list: ' . $e->getMessage());

            // Optionally, you can return a response to the user
            return response()->json(['error' => 'An error occurred while generating the PDF list.'], 500);
        }
    }
}
