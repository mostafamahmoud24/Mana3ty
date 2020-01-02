@extends('layouts.layout')
    @section('content')
    <body>
        <div class="container">
                <div class="container mt-5">
                        <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                                <form action="/search/diagnoses" method="GET">
                                  <div class="container">
                                      <input type="text" placeholder="Search Diagnoses... (Date: m/d/y)" class="search w-100" name="query" id="query" value="{{request()->input('query')}}">
                                      <div class=text-danger>{{$errors->first('query')}}</div>
                                    </div>
                              </form>
                          </div>
                        <div class="col-2"></div>
                       
                    </div>
                    </div>
                    <hr>
    </div>
    
    <div class="container">
        <p class="text-white mb-1">{{$search->count()}} result(s) for '{{request()->input('query')}}'</p></div>
    <div class="container bg-white" id="table-container">
        
            <div class="row text-center mb-2 mt-3">
                <div class="col-1 mb-1"><strong>ID</strong></div>
                <div class="col-1 mb-1"><strong>Visit</strong></div>
                <div class="col-3 mb-1"><strong>Patient Name</strong></div>
                <div class="col-2 mb-1"><strong>Diagnosis</strong></div>
                <div class="col-2 mb-1"><strong>Doctor</strong></div>
                <div class="col-3 mb-1"><strong>Date</strong></div>
            </div>
            <hr>
    

    @foreach ($search as $s)
        <a href="/patients/{{$s->patient->id}}/diagnoses/{{$s->id}}" id="fields" class="text-dark">
            <div class="row text-center">
                <div class="col-1 mb-1">{{$s->patient->id}}</div>
                <hr>
                <div class="col-1 mb-1">{{$s->visit_num}}</div>
                <hr>
                <div class="col-3 mb-1">{{$s->name}}</div>
                <hr>
                <div class="col-2 mb-1">{{$s->illness}}</div>
                <hr>
                <div class="col-2">{{$s->user->name}}</div> 
                <hr>
                <div class="col-3 mb-1">{{ date('d-M-Y - h:i a', strtotime($s->created_at)) }}</div>
            </div>
        </a> 
    @endforeach

    

    <div class="row">
            <div class="col-12 d-flex justify-content-center mt-5">{{$search->links()}}</div>
        </div>
    </div>
@endsection()
