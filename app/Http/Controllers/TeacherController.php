<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Teacher;
use Brian2694\Toastr\Facades\Toastr;

class TeacherController extends Controller
{
    /** Afficher la page d'ajout d'encadreur */
    public function teacherAdd()
    {
        return view('teacher.add-teacher');
    }

    /** Afficher la liste des encadreurs */
    public function teacherList()
    {
        $listTeacher = Teacher::all();
        return view('teacher.list-teachers', compact('listTeacher'));
    }

    /** Afficher la grille des encadreurs */
    public function teacherGrid()
    {
        $teacherGrid = Teacher::all();
        return view('teacher.teachers-grid', compact('teacherGrid'));
    }

    /** Enregistrer un encadreur */
    public function saveRecord(Request $request)
    {
        $request->validate([
            'Nom'       => 'required|string',
            'Prenoms'   => 'required|string',
            'Telephone' => 'required',
            'email'     => 'required|email',
            'adresse'   => 'required|string',
            'grade'     => 'required|string',
            'departement' => 'required|string', 
        ]);

        try {
            $saveRecord = new Teacher;
            $saveRecord->Nom = $request->Nom;
            $saveRecord->Prenoms = $request->Prenoms;
            $saveRecord->email = $request->email;
            $saveRecord->Telephone = $request->Telephone;
            $saveRecord->adresse = $request->adresse;
            $saveRecord->grade = $request->grade;
            $saveRecord->departement = $request->departement; 
            $saveRecord->save();

            Toastr::success('Ajout avec succès :)', 'Succès');
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::info($e);
            DB::rollback();
            Toastr::error('Erreur d\'ajout :)', 'Erreur');
            return redirect()->back();
        }
    }

    /** Modifier un encadreur */
    public function editRecord($id)
    {
        $teacher = Teacher::where('id', $id)->first();
        return view('teacher.edit-teacher', compact('teacher'));
    }

    /** Mettre à jour un encadreur */
    public function updateRecordTeacher(Request $request)
    {
        DB::beginTransaction();
        try {
            $updateRecord = [
                'Nom'       => $request->Nom,
                'Prenoms'   => $request->Prenoms,
                'Telephone' => $request->Telephone,
                'email'     => $request->email,
                'adresse'   => $request->adresse, 
                'grade'     => $request->grade,
                'departement' => $request->departement, 
            ];

            Teacher::where('id', $request->id)->update($updateRecord);

            Toastr::success('Modification avec succès :)', 'Succès');
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Erreur de modification :)', 'Erreur');
            return redirect()->back();
        }
    }

    /** Supprimer un encadreur */
    public function teacherDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            Teacher::destroy($request->id);
            DB::commit();
            Toastr::success('Suppression avec succès :)', 'Succès');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Erreur de suppression :)', 'Erreur');
            return redirect()->back();
        }
    }
}
