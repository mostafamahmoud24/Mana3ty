@include('layouts.layout')

<div class="container">

    <div class="row ml-1">
        <p><a href="{{url('patients/' . $patient->id)}}" class="btn btn-warning  mt-3">BACK</a></p>
    </div>

    <hr>

    <div class="row mt-3">
        <h3 class='text-white ml-3'>Visit Details</h3>
    </div>

    <div class="container bg-white" id="table-container">
        <div class="row">
            <div class="col-6 mt-2">
                <p class=""><strong>Name: </strong>{{$patient->name}}</p>
                <p class=""><strong>Patient ID: </strong>{{$patient->id}}</p>
                <p class=""><strong>Visit No.: </strong>{{$diagnosis->visit_num}}</p>
                <p class=""><strong>Diagnosis: </strong>{{$diagnosis->illness}}</p>
                <p class=""><strong>Comments: </strong>{{$diagnosis->comment}}</p>
            </div>
                    
            <div class="col-6 mt-2">
                <label for=""class=''><strong>Diagnosis Date: </strong></label>
                <ul>
                    <li>{{ date('d-M-Y ', strtotime($diagnosis->created_at)) }}</li>
                </ul>
                <label for=""class=''><strong>Doctor: </strong></label>
                <ul>
                    <li class="">Dr. {{$diagnosis->user->name}} ({{$diagnosis->user->speciality}})</li>
                </ul>
            </div>
        </div>
    </div>

    <hr>

    @if ($diagnosis->image)
        <div class="row">
            <div class="col-12">
                <h3 class="text-white">Patient File</h3>
                <img src="{{asset('storage/' . $diagnosis->image)}}" alt="" class="img-thumbnail img-responsive">
            </div>
        </div>
    @endif

    <div class="row">
        <p><a href="/patients/{{$patient->id}}/diagnoses/{{$diagnosis->id}}/edit" class="btn btn-primary mt-3 ml-3">Edit</a></p>
        <form action="/patients/{{$patient->id}}/diagnoses/{{$diagnosis->id}}" method="Post">
            @method("DELETE")
            @csrf
            <button type="submit" class="btn btn-danger mt-3 ml-3">Delete</button>
        </form>
    <a href="/patients/{{$patient->id}}/diagnoses/{{$diagnosis->id}}/images" class="btn btn-primary mt-3 ml-3 mb-3">Uploaded Files</a>
    </div>

</div>

