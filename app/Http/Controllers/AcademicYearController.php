<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicYear;
use DB;

class AcademicYearController extends Controller
{
    public function index() {
        $acayear = DB::table('acayear')->orderByDesc('acaYearID')->paginate(10);
        return view('ideatimes.index', compact('acayear'));
    }

    public function addAcaYear() {
        return view('ideatimes.add');
    }

    public function saveAcaYear(Request $request) {
        $this->validate($request, [
            'semester' => 'required',
            'openDate' => 'required',
            'closeDate' => 'required'
        ], [
            'semester.required' => 'Please Enter Semester',
            'openDate.required' => 'Please Enter Open Date',
            'closeDate.required' => 'Please Enter Close Date',
        ]);
        $saveAcaYear = new AcademicYear;
        $saveAcaYear->semester = $request->input('semester');
        $saveAcaYear->openDate = $request->input('openDate');
        $saveAcaYear->closeDate = $request->input('closeDate');
        $saveAcaYear->save();
        return redirect('/idea/academicyear')->with('notify', 'addSuccess');
    }

    public function getEditAcaYear(Request $request, $id) {
        $acaYear = DB::table('acayear')->where('semester', $id)->first();
        return view('ideatimes.edit', compact('acaYear'));
    }

    public function postEditAcaYear(Request $request, $id) {
        $this->validate($request, [
            'semester' => 'required',
            'openDate' => 'required',
            'closeDate' => 'required'
        ], [
            'semester.required' => 'Please Enter Semester',
            'openDate.required' => 'Please Enter Open Date',
            'closeDate.required' => 'Please Enter Close Date',
        ]);
        $edit = AcademicYear::where('semester', $id)->first();
        $edit->semester = $request->input('semester');
        $edit->openDate = $request->input('openDate');
        $edit->closeDate = $request->input('closeDate');
        $edit->update();
        return redirect('/idea/academicyear')->with('notify', 'editSuccess');
    }

    public function DelAcaYear(Request $request, $id) {
        $del = AcademicYear::where('semester', $id)->first();
        $del->delete();
        return redirect('/idea/academicyear')->with('notify', 'addSuccess');
    }
}
