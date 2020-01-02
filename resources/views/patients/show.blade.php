@include('layouts.layout')

<div class="container">
<div class="row ml-1">
    <p><a href="{{url('/')}}" class="btn btn-warning mt-3">BACK</a></p>
</div>

<hr>
    <div class="row mt-3">
        <h3 class='text-white ml-3'>Details for {{$patient->name}}</h3>
        
    </div>


<div class="container bg-white" id="table-container">
    <div class="row">
        <div class="col-6 mt-2">
            <p class=""><strong>Name: </strong>{{$patient->name}}</p>
            <p class=""><strong>ID: </strong>{{$patient->id}}</p>
            <p class=""><strong>Telephone: </strong>{{$patient->phone}}</p>
            <p class=""><strong>Date: </strong>{{ date('d-M-Y - h:i a', strtotime($patient->created_at)) }}</p>
        </div>
            
        <div class="col-6 mt-2">
            <label for=""class=''><strong>Doctors: </strong></label>
            <ul>
                @foreach ($patient->users as $p)
                    <li class="">Dr. {{$p->name}} ({{$p->speciality}})</li>
                @endforeach
                {{-- @foreach ($patient->diagnoses as $p)
                    <li class="">Dr. {{$p->user->name}} ({{$p->user->speciality}})</li>
                @endforeach --}}
            </ul>
        </div>
    </div>
</div>

<div class="row">
<p><a href="/patients/{{$patient->id}}/edit" class="btn btn-primary mt-3 ml-3">Edit</a></p>
        <form action="/patients/{{$patient->id}}" method="Post">
            @method("DELETE")
            @csrf
            <button type="submit" class="btn btn-danger mt-3 ml-3">Delete</button>
        </form>
</div>

<hr>
<br>

<div class="row">
        <h3 class='text-white ml-3'>{{$patient->name}}'s Visits:</h3>
</div>

<div class="container bg-white" id="table-container">
        
    <div class="row text-center mb-2 mt-3">
        <div class="col-1 mb-1"><strong>Visit No.</strong></div>
        <div class="col-3 mb-1"><strong>Name</strong></div>
        <div class="col-2 mb-1"><strong>diagnosis</strong></div>
        <div class="col-3 mb-1"><strong>Doctor</strong></div>
        <div class="col-3 mb-1"><strong>Date</strong></div>
    </div>

    <hr>
    
    @foreach ($patient->diagnoses->sortByDesc("created_at") as $p)
        <a href="/patients/{{$patient->id}}/diagnoses/{{$p->id}}" id="fields" class="text-dark">
            <div class="row text-center">
                <div class="col-1 mb-1">{{$p->visit_num}}</div>
                <hr>
                <div class="col-3 mb-1">{{$p->name}}</div>
                <hr>
                <div class="col-2 mb-1">{{$p->illness}}</div>
                <hr>
                <div class="col-3 mb-1">{{$p->user->name}}</div>
                <hr>
                <div class="col-3 mb-1">{{ date('d-M-Y - h:i a', strtotime($p->created_at)) }}</div>
            </div>
        </a> 
    @endforeach
    <br>

</div>

    <br>

    <a href="/patients/{{$patient->id}}/diagnoses/create" class="btn btn-primary">Create New Diagnosis</a>

    

</div>













