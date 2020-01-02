@include('layouts.layout')
<div class="container">
<a href="{{url('patients/' . $patient->id . ' /diagnoses/' . $diagnosis->id)}}" class="btn btn-warning mt-3">BACK</a>
<div class="row">
        <div class="col-12 mt-2 text-white">
        <h1>Edit Details for visit no.{{$diagnosis->visit_num}}</h1>
        </div>
    
    </div>
    
    <div class="row">
        <div class="col-12">
    
        <form action="/patients/{{$patient->id}}/diagnoses/{{$diagnosis->id}}" method ="POST" class="pb-5"  enctype="multipart/form-data">
            @method('PATCH')
                <div class="form-group">
                        <input type="hidden" placeholder = "Visit No." name = "visit_num" class="form-control" value = "{{old('visit_num') ?? $diagnosis->visit_num}}" >
                    <hr>
                    <label for="illness" class="text-white">Diagnosis</label>
                        <input type="text" placeholder = "Patient Diagnosis..." name = "illness" class="form-control" value = "{{old('illness') ?? $diagnosis->illness}}" >
                        <div class=text-danger>{{$errors->first('illness')}}</div>
                    <hr>
                    <div class="form-group">
                    <label for="Doctor" class="text-white">Comments</label> 
                    <div>
                        <textarea type="textarea" placeholder = "Comments..." name = "comment" class="form-control" value = "{{old('comment') ?? $diagnosis->comment}}" >{{old('comment') ?? $diagnosis->comment}}</textarea>
                    <div class=text-danger>{{$errors->first('comment')}}</div>
                    <hr>
                </div>
                <input type="hidden" name="patient_id" value="{{$patient->id}}">
                <input type="hidden" name="name" value="{{$patient->name}}">

                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                
                    @csrf
    
                <button type="submit" class="btn btn-primary"><strong>Save Diagnosis</strong></button>
            </form>
        </div>
    </div>
</div>