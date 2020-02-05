@include('layouts.layout')

<div class="container">
<a href="{{url('patients/' . $patient->id)}}" class="btn btn-warning mt-3">BACK</a>
<div class="row">
        <div class="col-12 mt-3 text-white">
                <h1>Add New Diagnosis</h1>
        </div>
    
    </div>
    
    <div class="row">
        <div class="col-12">
    
        <form action="{{url('patients/' . $patient->id)}}" method ="POST" class="pb-5" enctype="multipart/form-data">
                <div class="form-group">
                    @if ($patient->diagnoses->last() === null)
                    <input type="hidden" placeholder = "Visit No." name = "visit_num" class="form-control" value = "{{1}}" >
                    @else    
                    <input type="hidden" placeholder = "Visit No." name = "visit_num" class="form-control" value = "{{$patient->diagnoses->last()->visit_num + 1}}" >
                    @endif
                    
                    <hr>

                    <label for="illness" class="text-white">Diagnosis</label>
                    <input type="text" placeholder = "Patient Diagnosis..." name = "illness" class="form-control" value = "{{old('illness') ?? $diagnosis->illness}}" >
                    <div class=text-danger>{{$errors->first('illness')}}</div>
                    <hr>

                    <label for="comment" class="text-white">Comments</label> 
                    <textarea type="textarea" placeholder = "Comments..." name = "comment" value = "{{old('comment')?? $diagnosis->comment}}" class="form-control"></textarea>
                    <div class=text-danger>{{$errors->first('comment')}}</div>

                    <hr>

                <input type="hidden" name="patient_id" value="{{$patient->id}}">
                <input type="hidden" name="name" value="{{$patient->name}}">

                {{-- <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> --}}
                <select class="btn btn-secondary dropdown-toggle" name="user_id">
                    <option disabled label="Select Doctor" class="bg-white" selected>Select Doctor</option>
                    @foreach ($users as $user)
                        <option value="{{$user->id}}"  class="rounded">{{$user->name}}</option>
                    @endforeach
                  </select>

                  {{-- <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Select Doctor
                    </button>
                    <div class="dropdown-menu dropdown-menu-center">
                      @foreach ($users as $user)
                      <button class="dropdown-item" type="button" value="{{$user->id}}">{{$user->name}}</button>
                    @endforeach
                    </div>
                  </div> --}}

                </div>

                </div>

                
                    @csrf
    
                <button type="submit" class="btn btn-primary ml-3">
                    <strong>Add Diagnosis</strong>
                </button>
            </form>
        </div>
    </div>
</div>

