<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function index()
    {
        $acayears = AcademicYear::all();
        return view('academicyear.index', compact('acayears'));
    }
    public function getAddAcaYear()
    {
        return view('academicyear.add');
    }
    public function postAddAcaYear(Request $request)
    {
        $acayear = new AcademicYear;
        $acayear->academicYearName = $request->input('academicYearName');
        $acayear->open_date = $request->input('open_date');
        $acayear->close_date = $request->input('close_date');
        $acayear->save();
        return redirect('/ideas/acayear');
    }
    public function getEditAcaYear($id_acayear)
    {
        $acayear = AcademicYear::findOrFail($id_acayear);
        return view('academicyear.edit', compact('acayear'));
    }
    public function postEditAcaYear(Request $request, $id_acayear)
    {
        $acayear = AcademicYear::findOrFail($id_acayear);
        $acayear->academicYearName = $request->input('academicYearName');
        $acayear->open_date = $request->input('open_date');
        $acayear->close_date = $request->input('close_date');
        $acayear->update();
        return redirect('/ideas/acayear');
    }
    public function getDeleteAcaYear($id_acayear)
    {
        $acayear = AcademicYear::findOrFail($id_acayear);
        $acayear->delete();
        return redirect()->back();
    }
}
