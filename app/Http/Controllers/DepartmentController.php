<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Brian2694\Toastr\Facades\Toastr;
use DB;

class DepartmentController extends Controller
{
    /** List departments */
    public function index()
    {
        $departments = Department::all();
        return view('department.list-department', compact('departments'));
    }

    /** Page for adding a department */
    public function showAddForm()
    {
        return view('department.add-department');
    }

    /** Save new department */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $department = new Department;
            $department->name = $request->name;
            $department->description = $request->description;
            $department->save();

            Toastr::success('Département ajouté avec succès :)', 'Succès');
            DB::commit();
            return redirect()->route('departments.list');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Erreur lors de l\'ajout du département :)', 'Erreur');
            return redirect()->back();
        }
    }

    /** View for editing a department */
    public function showEditForm($id)
    {
        $department = Department::findOrFail($id);
        return view('department.edit-department', compact('department'));
    }

    /** Update department record */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $department = Department::findOrFail($id);
            $department->name = $request->name;
            $department->description = $request->description;
            $department->save();

            Toastr::success('Département modifié avec succès :)', 'Succès');
            DB::commit();
            return redirect()->route('departments.list');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Erreur lors de la modification du département :)', 'Erreur');
            return redirect()->back();
        }
    }

    /** Delete department */
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $department = Department::findOrFail($request->id);
            $department->delete();

            Toastr::success('Département supprimé avec succès :)', 'Succès');
            DB::commit();
            return redirect()->route('departments.list');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Erreur lors de la suppression du département :)', 'Erreur');
            return redirect()->back();
        }
    }
}
