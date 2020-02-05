<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use App\User;
use App\Diagnosis;
use App\UploadImage;


class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
     public function index(Patient $patient, Diagnosis $diagnosis)
    {
        $patients = DB::table('patients')->paginate(14);
        // $users = Auth::user();
        $diagnoses = Diagnosis::all();
        $patiento = Patient::all();
        // $new = Patient::find(2);


        return view('patients.welcome', compact('patients', 'diagnoses', 'patient', 'patiento'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient, User $user)
    {
        $patientu = new Patient();
        $users = User::all();
        $patiento = Patient::all();
        // $arr = [];

        

        return view('patients.create', compact('patient', 'patientu', 'users', 'patiento', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Patient $patient)
    {
        
        
        $patient = Patient::create($this->validateRequest());
        $users = User::all();
        foreach ($users as $use) {
            $x = $use->id;
            $user_id = $request->input($x);
            if ($user_id !== null) {
                $user = User::find($user_id);
                $user->patients()->sync($patient->id);
            }
            
        }
        
        // $user = Auth::user();
        return redirect('patients/' . $patient->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient, Diagnosis $diagnosis)
    {
        $images = UploadImage::latest()->get();
        $diagnoses = Diagnosis::all();
        $users = User::all();
        $patients = Patient::all();

        return view('patients.show', compact('patient', 'users', 'patients', 'diagnosis', 'patients', 'images', 'diagnoses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient, User $user)
    {
        $patientu = new Patient();
        $users = User::all();
        $patiento = Patient::all();
        // $arr = [];

        

        return view('patients.edit', compact('patient', 'patientu', 'users', 'patiento', 'user'));

        // return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {

            $edit = $patient->update($this->validateRequest());
            $users = User::all();

            foreach ($users as $use) {
                $x = $use->id;
                if ($x >= 0) {
                    $user = User::find($x);
                    $user->patients()->detach($patient->id);
                }
            }

            foreach ($users as $use) {
            $x = $use->id;
            $user_id = $request->input($x);
            if ($user_id !== null) {
                $user = User::find($user_id);
                $user->patients()->attach($patient->id);
            }
            
        }

            return redirect('patients/' . $patient->id); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        foreach($patient->diagnoses as $diag) {
            $diag->delete();
        }

        return redirect('/');
    }

    private function validateRequest()
    {
        return request()->validate([ 
            'name' => 'required|min:3',
            'phone' => 'required',
            ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required',
        ]);

        $query = $request->input('query');

        $search = Patient::whereHas('users', function($x) use ($query)
        {
            $x->where('name', 'like', "%$query%");
        })
                            ->orwhere('name', 'like', "%$query%")
                            ->orwhere('id', 'like', "%$query%")
                            ->orwhere('phone', 'like', "%$query%")
                            ->orwhere('created_at', 'like', "%$query%")
                            ->paginate(14);

        return view('patients.search', compact('search'));
    }

}