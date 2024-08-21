<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Teacher;
use App\Models\Department;

class TeacherController extends Controller
{
    /** Afficher la page d'ajout d'encadreur */
    public function teacherAdd()
    {
        $departments = Department::all(); 
        return view('teacher.add-teacher', compact('departments'));
    }

    /** Afficher la page d'édition d'encadreur */
    public function editRecord($id)
    {
        $teacher = Teacher::findOrFail($id);
        $departments = Department::all(); 
        return view('teacher.edit-teacher', compact('teacher', 'departments'));
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
            'Nom'          => 'required|string',
            'Prenoms'      => 'required|string',
            'Telephone'    => 'required',
            'email'        => 'required|email',
            'adresse'      => 'required|string',
            'grade'        => 'required|string',
            'department_id'=> 'required|exists:departments,id', 
        ]);

        try {
            $saveRecord = new Teacher;
            $saveRecord->Nom = $request->Nom;
            $saveRecord->Prenoms = $request->Prenoms;
            $saveRecord->email = $request->email;
            $saveRecord->Telephone = $request->Telephone;
            $saveRecord->adresse = $request->adresse;
            $saveRecord->grade = $request->grade;
            $saveRecord->department_id = $request->department_id; 
            $saveRecord->save();

            Toastr::success('Ajout avec succès :)', 'Succès');
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error($e);
            Toastr::error('Erreur d\'ajout :)', 'Erreur');
            return redirect()->back();
        }
    }

    /** Modifier un encadreur */
    public function updateRecordTeacher(Request $request)
    {
        $request->validate([
            'Nom'          => 'required|string',
            'Prenoms'      => 'required|string',
            'Telephone'    => 'required',
            'email'        => 'required|email',
            'adresse'      => 'required|string',
            'grade'        => 'required|string',
            'department_id'=> 'required|exists:departments,id',
        ]);

        try {
            $updateRecord = [
                'Nom'          => $request->Nom,
                'Prenoms'      => $request->Prenoms,
                'Telephone'    => $request->Telephone,
                'email'        => $request->email,
                'adresse'      => $request->adresse,
                'grade'        => $request->grade,
                'department_id'=> $request->department_id, 
            ];

            Teacher::where('id', $request->id)->update($updateRecord);

            Toastr::success('Modification avec succès :)', 'Succès');
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error($e);
            Toastr::error('Erreur de modification :)', 'Erreur');
            return redirect()->back();
        }
    }

    /** Supprimer un encadreur */
    public function teacherDelete(Request $request)
    {
        try {
            Teacher::destroy($request->id);
            Toastr::success('Suppression avec succès :)', 'Succès');
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error($e);
            Toastr::error('Erreur de suppression :)', 'Erreur');
            return redirect()->back();
        }
    }
}
