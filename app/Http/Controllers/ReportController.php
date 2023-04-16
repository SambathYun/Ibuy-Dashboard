<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function index(Request $request)
    {
        $report = Report::all();

        return view('dashboard.reports')->with(compact('report'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        //https://www.webslesson.info/2019/04/laravel-58-ajax-crud-tutorial-using-datatables.html
        $rules = array(
            'title' => 'required',
            'price' => 'required',
            'qty' => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }


        if ($request->ajax()) {

            $form_data = $request->validate([
                'title' => 'required|max:255',
                'price' => 'required',
                'qty' => 'required',
            ]);

            $report = Report::create($form_data);

            return response()->json($report);
        }
    }

    public function show(Report $report)
    {
        //
    }


    public function edit($id, Request $request)
    {
        if (request()->ajax()) {

            $form_data = $request->validate([
                'title' => 'required',
                'price' => 'required',
                'qty' => 'required',
            ]);

            $report = Report::where('id', $id)
                ->update($form_data);

            return response()->json($report);
        }
    }


    public function update(Request $request, Report $report)
    {
        // $id = $request->input('id');
        // $report = Report::find($id);

        // return response()->json($report);
    }


    public function destroy(Report $report)
    {
    }
}
