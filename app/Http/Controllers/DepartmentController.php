<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /** index page department */
    public function addDepartment()
    {
        return view('department.add-department');
    }
    
    /** edit record */
    public function editDepartment()
    {
        return view('department.edit-department');
    }

    /** department list */
    public function departmentList()
    {
        return view('department.list-department');
    }
}
