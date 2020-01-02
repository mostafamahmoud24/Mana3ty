@include('layouts.layout')

<div class="container">
    <a href="{{url('patients/' . $patient->id)}}" class="btn btn-warning mt-3">BACK</a>

    <div class="row mt-2">
        <div class="col-12 mt-2 text-white">
            <h1>Edit Details for {{$patient->name}}</h1>
        </div>  
    </div>
        
    <div class="row">
        <div class="col-12">
            <form action="/patients/{{$patient->id}}" method ="POST" class="pb-5">
                @method('PATCH')
                <div class="form-group">
                    <label for="name" class="text-white mt-3">Name</label>
                    <div class=text-danger>{{$errors->first('name')}}</div>
                    <input type="text" placeholder = "Patient Name" name = "name" class="form-control" value = "{{old('name') ?? $patient->name}}" >
                </div>

                <hr>

                <div>
                    <label for="email" class="text-white">Telephone</label> 
                    <input type="text" placeholder = "Patient Telephone/Mob." name = "phone" value = "{{old('phone')?? $patient->phone}}" class="form-control">
                    <div class=text-danger>{{$errors->first('phone')}}</div>
                </div>

                <hr>

                <label for="" class="text-white">Doctors</label>

                <div class="form-check">
                    @foreach ($users as $item)
                        <div class="ml-2">
                            <input type="checkbox" value="{{old('name') ?? $item->id}}" name="{{$item->id}}" class='form-check-input text-white' id='doctor'> 
                            <label for="doctor" class='form-check-label text-white'>{{$item->name}}</label>
                        </div>
                    @endforeach
                </div>   

                @csrf

                <hr>
        
                <button type="submit" class="btn btn-primary"><strong>Save Patient</strong></button>
            </form>
        </div>
    </div>
</div>