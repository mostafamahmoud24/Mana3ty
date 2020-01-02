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
                    <input type="hidden" placeholder = "Visit No." name = "visit_num" class="form-control" value = "{{$patient->diagnoses->last()->visit_num + 1}}" >

                    <hr>

                    <label for="illness" class="text-white">Diagnosis</label>
                    <div class=text-danger>{{$errors->first('illness')}}</div>
                    <input type="text" placeholder = "Patient Diagnosis..." name = "illness" class="form-control" value = "{{old('illness') ?? $diagnosis->illness}}" >

                    <hr>

                    <label for="comment" class="text-white">Comments</label> 
                    <textarea type="textarea" placeholder = "Comments..." name = "comment" value = "{{old('comment')?? $diagnosis->comment}}" class="form-control"></textarea>
                    <div class=text-danger>{{$errors->first('comment')}}</div>

                    <hr>

                <input type="hidden" name="patient_id" value="{{$patient->id}}">
                <input type="hidden" name="name" value="{{$patient->name}}">

                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

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

