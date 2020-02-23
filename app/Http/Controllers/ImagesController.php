<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use App\User;
use App\Diagnosis;
use App\UploadImage;



class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index($diagnosis, $patient)
    {
        $images = UploadImage::latest()->get();
 
        $diagnoses = DB::table('diagnoses')->get();

        return view('images.images', compact('images', 'diagnoses', 'diagnosis', 'patient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $ImageUpload = UploadImage::create($this->validateRequest());

        $this->storeImage($ImageUpload);

        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($patient, $diagnosis, $image)
    {

        $images = UploadImage::latest()->get();

        return view('images.show', compact('patient', 'diagnosis', 'image', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UploadImage $uploadImage, Patient $patient, Diagnosis $diagnosis)
    {

        

        // File::delete(public_path(' /public/storage/uploads/' . $uploadImage->image));
        // $image_path = $uploadImage->image;  
        //     if(file_exists($image_path)) {
        //         File::delete($image_path);
        //     }
        File::delete([
            public_path('storage/' . $uploadImage->image, 8)
        ]);

        // if(\File::exists(public_path('storage/' . $uploadImage->image, 8))){

        //     \File::delete(public_path(substr($uploadImage->image, 8)));
        
        //   }else{
        
        //     dd(public_path('storage/' . $uploadImage->image, 8));
        
        //   }

          $uploadImage->delete();


        //   C:\xampp\htdocs\patientapp\public\storage\uploads\8WI2yQdkBLGx2GCUYiEqBduBBye2oPCH500OsBcM.jpeg

        //   public\storage\uploads\8WI2yQdkBLGx2GCUYiEqBduBBye2oPCH500OsBcM.jpeg
        //   if(\Storage::exists('app/public/uploads' . substr($uploadImage->image, 8))){

        //     \Storage::delete('app/public/uploads' . substr($uploadImage->image, 8));

        //   }else{
        
        //     dd('File does not exists.');
        
        //   }

        // $this->deleteImage($uploadImage->image);

        // Storage::delete([
        //     public_path('/' .'uploads/' . $uploadImage->image)
        // ]);

        $d = $diagnosis->find($uploadImage->diagnosis_id)->id;

        $p = $patient->find($diagnosis->find($d)->patient_id)->id;

        

        return redirect("patients/" . $p . " /diagnoses/" . $d . '/images');
    }

    private function validateRequest()
    {
        return request()->validate([ 
            'diagnosis_id' => 'required',
            'image' => 'required|file|image'
            ]);
    }

    private function storeImage($ImageUpload) {
        if (request()->has('image')) {
            $ImageUpload->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);
        }
    }
}

