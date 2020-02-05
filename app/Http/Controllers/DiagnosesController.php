<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use App\User;
use App\Diagnosis;

class DiagnosesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient, Diagnosis $diagnosis)
    {
        $diagnoses = DB::table('diagnoses')->paginate(14);
        $doctors = User::all();

        return view('diagnoses.welcome', compact('diagnoses', 'patient', 'diagnosis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $diagnosis = new Diagnosis();
        $user = Auth::user();
        $users = User::all();
        return view('diagnoses.create', compact('diagnosis', 'user', 'patient', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Patient $patient, Request $request)
    {
        $diagnoses = Diagnosis::create($this->validateRequest());
        $diagnosis = Diagnosis::latest()->first();

        return redirect('patients/' . $patient->id . ' /diagnoses/' . $diagnosis->id); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, Diagnosis $diagnosis)
    {
        
        $patients = Patient::all();
        $users = User::all();

        return view('diagnoses.show', compact('patients', 'users', 'diagnosis', 'patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, Diagnosis $diagnosis)
    {
        $users = User::all();
        return view('diagnoses.edit', compact('diagnosis', 'patient', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Patient $patient, Diagnosis $diagnosis)
    {
        $diagnosis->update($this->validateRequest());

        return redirect('patients/' . $patient->id . ' /diagnoses/' . $diagnosis->id); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient, Diagnosis $diagnosis)
    {
        $diagnosis->delete();

        return redirect('patients/' . $patient->id);
    }

    private function validateRequest()
    {

        return request()->validate([ 
            'visit_num' => 'required|int',
            'name' => 'required',
            'comment' => 'min:0',
            'illness' => array(
                'min:0',
                'regex:/(^([a-zA-Z]+)(\d+)?$)/u'
            ),
            'user_id' => 'required',
            'patient_id' => 'required',
            ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required',
        ]);
        
        $query = $request->input('query');

        $search = Diagnosis::whereHas('patient', function($x) use ($query) {
            $x->where('name', 'like', "%$query%");
        })->orWhereHas('user', function($x) use ($query)
        {
            $x->where('name', 'like', "%$query%");
        })
            ->orwhere('id', 'like', "%$query%")
            ->orwhere('visit_num', 'like', "%$query%")
            ->orwhere('created_at', 'like', "%$query%")
            ->paginate(14);

        return view('diagnoses.search', compact('search'));
    }
}