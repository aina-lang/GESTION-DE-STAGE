<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Student;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class StudentController extends Controller
{
    /** index page student list */
    public function student()
    {
        $studentList = Student::all();
        return view('student.student',compact('studentList'));
    }

    /** index page student grid */
    public function studentGrid()
    {
        $studentList = Student::all();
        return view('student.student-grid',compact('studentList'));
    }

    /** student add page */
    public function studentAdd()
    {
        return view('student.add-student');
    }

    /** student save record */
    public function studentSave(Request $request)
    {
        $request->validate([
            'Nom'      => 'required|string',
            'Prenoms'  => 'required|string',
            'Genre'    => 'required|not_in:0',
            'Age'      => 'required|integer',
            'Adresse'  => 'required|string',
            'email'    => 'required|email',
            'Niveau'   => 'required|string',
            'Telephone'=> 'required',
            'upload'   => 'required|image',
        ]);

        DB::beginTransaction();
        try {

            $upload_file = rand() . '.' . $request->upload->extension();
            $request->upload->move(storage_path('app/public/student-photos/'), $upload_file);
            if(!empty($request->upload)) {
                $student = new Student;
                $student->Nom = $request->Nom;
                $student->Prenoms = $request->Prenoms;
                $student->Genre = $request->Genre;
                $student->Age= $request->Age;
                $student->Adresse = $request->Adresse;
                $student->email = $request->email;
                $student->Niveau = $request->Niveau;
                $student->Telephone = $request->Telephone;
                $student->upload = $upload_file;
                $student->save();

                Toastr::success('Ajouter avec succes :)','Succées');
                DB::commit();
            }

            return redirect()->back();


        } catch(\Exception $e) {
            DB::rollback();
            echo $e;return;
            Toastr::error('Erreur,Ajouter un nouveau :)','Error');
            return redirect()->back();
        }
    }

    /** view for edit student */
    public function studentEdit($id)
    {
        $studentEdit = Student::where('id',$id)->first();
        return view('student.edit-student',compact('studentEdit'));
    }

    /** update record */
    public function studentUpdate(Request $request)
    {

        // var_dump($request->all());return;
        DB::beginTransaction();
        try {

            if (!empty($request->upload)) {
                unlink(storage_path('app/public/student-photos/'.$request->image_hidden));
                $upload_file = rand() . '.' . $request->upload->extension();
                $request->upload->move(storage_path('app/public/student-photos/'), $upload_file);
            } else {
                $upload_file = $request->image_hidden;
            }

            $updateRecord = [
                'upload' => $upload_file,
                'Nom'=>$request->Nom,
                'Prenoms' => $request->Prenoms,
                'Genre' => $request->Genre,
                'Age'=>$request->Age,
                'Adresse'=> $request->Adresse,
               'email' => $request->email,
                'Niveau'=>$request->Niveau,
                'Telephone' => $request->Telephone
            ];
          
            Student::where('id',$request->id)->update($updateRecord);

            Toastr::success('Modification avec succées :)','Succées');
            DB::commit();
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            // echo $e;return;
            Toastr::error('fail, update student  :)','Error');
            return redirect()->back();
        }
    }

    /** student delete */
    public function studentDelete(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!empty($request->id)) {
                Student::destroy($request->id);
                unlink(storage_path('app/public/student-photos/'.$request->avatar));
                DB::commit();
                Toastr::success('Student deleted successfully :)','Succées');
                return redirect()->back();
            }

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Student deleted fail :)','Error');
            return redirect()->back();
        }
    }

    /** student profile page */
    public function studentProfile($id)
    {
        $studentProfile = Student::where('id',$id)->first();
        return view('student.student-profile',compact('studentProfile'));
    }
}
