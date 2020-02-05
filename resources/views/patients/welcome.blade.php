@extends('layouts.layout')
    @section('content')
    <body>
        <div class="container-fluid container">
        <div class="container-fluid container mt-5">
                <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                        <form action="/search/patients" method="GET">
                          <div class="container">
                          <input type="text" placeholder="Search Patients... (Date: m/d/y)" class="search w-100" name="query" id="query" value="{{request()->input('query')}}">
                            </div>
                      </form>
                  </div>
                <div class="col-sm-2"></div>
            </div>
            </div>
        
        <hr>
    </div>
    <div class="container bg-white" id="table-container">
        
            <div class="row text-center mb-2 mt-3">
                <div class="col-1 mb-1"><strong>ID</strong></div>
                <div class="col-4 mb-1"><strong>Name</strong></div>
                <div class="col-3 mb-1"><strong>Telephone</strong></div>
                <div class="col-4 mb-1"><strong>Date</strong></div>
            </div>
            <hr>
    

    @foreach ($patients as $patient)
        <a href="/patients/{{$patient->id}}" id="fields" class="text-dark">
            <div class="row text-center">
                <div class="col-1 mb-1">{{$patient->id}}</div>
                <hr>
                <div class="col-4 mb-1">{{$patient->name}}</div>
                <hr>
                <div class="col-3 mb-1">{{$patient->phone}}</div>
                <hr>
                <div class="col-4 mb-1">{{ date('d-M-Y', strtotime($patient->created_at)) }}</div>
            </div>
        </a> 
    @endforeach

    <div class="row">
            <div class="col-12 d-flex justify-content-center mt-5">{{$patients->links()}}</div>
        </div>
    </div>

    <div class="container text-center mt-3">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4 center-block">
                    <a href="patients/create" style="text-decoration:none" class="new-patient">
                        <button class="btn btn-primary">
                        Create New Patient
                        </button>
                    </a>
                </div>
                <div class="col-4"></div>
            </div>
        </div>





@endsection()
