<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /** Afficher la liste des étudiants */
    public function student()
    {
        $studentList = Student::all();

        return view('student.student', compact('studentList'));
    }

    /** Afficher la grille des étudiants */
    public function studentGrid()
    {
        $studentList = Student::all();
        return view('student.student-grid', compact('studentList'));
    }

    /** Afficher la page d'ajout d'un étudiant */
    public function studentAdd()
    {
        // Fetch all departments (or other relevant data)
        $departments = Department::all();

        // Return the view with departments data
        return view('student.add-student', compact('departments'));
    }

    /** Sauvegarder un étudiant */
    public function studentSave(Request $request)
    {
        $request->validate([
            'Nom'          => 'required|string',
            'Prenoms'      => 'required|string',
            'Genre'        => 'required|not_in:0',
            'Age'          => 'required|integer',
            'Adresse'      => 'required|string',
            'email'        => 'required|email',
            'Niveau'       => 'required|string',
            'Telephone'    => 'required',
            'upload'       => 'required|image',
            'department_id' => 'required|exists:departments,id',
            'matricule'    => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $upload_file = rand() . '.' . $request->upload->extension();
            $request->upload->move(storage_path('app/public/student-photos/'), $upload_file);

            $student = new Student;
            $student->Nom = $request->Nom;
            $student->Prenoms = $request->Prenoms;
            $student->Genre = $request->Genre;
            $student->Age = $request->Age;
            $student->Adresse = $request->Adresse;
            $student->email = $request->email;
            $student->Niveau = $request->Niveau;
            $student->Telephone = $request->Telephone;
            $student->upload = $upload_file;
            $student->department_id = $request->department_id;
            $student->matricule = $request->matricule;
            $student->save();

            DB::commit();
            Toastr::success('Ajouté avec succès :)', 'Succès');
            return redirect()->route('student/list');
        } catch (\Exception $e) {

            var_dump($e->getMessage());
            exit;
            DB::rollback();
            Toastr::error('Erreur lors de l\'ajout :)', 'Erreur');
            return redirect()->back();
        }
    }

    /** Afficher la page d'édition d'un étudiant */
    public function studentEdit($id)
    {
        $studentEdit = Student::findOrFail($id);
        $departments = Department::all(); // Fetch departments for the edit view
        return view('student.edit-student', compact('studentEdit', 'departments'));
    }

    /** Mettre à jour les informations d'un étudiant */
    public function studentUpdate(Request $request)
    {

        DB::beginTransaction();
        try {
            $request->validate([
                'Nom'          => 'required|string',
                'Prenoms'      => 'required|string',
                'Genre'        => 'required|not_in:0',
                'Age'          => 'required|integer',
                'Adresse'      => 'required|string',
                'email'        => 'required|email',
                'Niveau'       => 'required|string',
                'Telephone'    => 'required',
                'department_id' => 'required|exists:departments,id',
                'matricule'    => 'required|string',

                'upload'       => 'nullable|image',
            ]);

            $student = Student::findOrFail($request->id);

            if ($request->hasFile('upload')) {
                // Remove old image
                $oldImagePath = storage_path('app/public/student-photos/' . $student->upload);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }

                // Save new image
                $upload_file = rand() . '.' . $request->upload->extension();
                $request->upload->move(storage_path('app/public/student-photos/'), $upload_file);
            } else {
                $upload_file = $student->upload;
            }

            $student->update([
                'upload'       => $upload_file,
                'Nom'          => $request->Nom,
                'Prenoms'      => $request->Prenoms,
                'Genre'        => $request->Genre,
                'Age'          => $request->Age,
                'Adresse'      => $request->Adresse,
                'email'        => $request->email,
                'Niveau'       => $request->Niveau,
                'Telephone'    => $request->Telephone,
                'department_id'  => $request->department_id,
                'matricule'    => $request->matricule,
            ]);

            DB::commit();
            Toastr::success('Modifié avec succès :)', 'Succès');
            return redirect()->route('student/list');
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
            DB::rollback();
            Toastr::error('Erreur lors de la mise à jour :)', 'Erreur');
            return redirect()->back();
        }
    }

    /** Supprimer un étudiant */
    public function studentDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $student = Student::findOrFail($request->id);

            // Remove student image
            $imagePath = storage_path('app/public/student-photos/' . $student->upload);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $student->delete();
            DB::commit();
            Toastr::success('Étudiant supprimé avec succès :)', 'Succès');
            return redirect()->route('student/list');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Erreur lors de la suppression :)', 'Erreur');
            return redirect()->back();
        }
    }

    /** Afficher le profil d'un étudiant */
    public function studentProfile($id)
    {
        $studentProfile = Student::findOrFail($id);
        return view('student.student-profile', compact('studentProfile'));
    }
}
