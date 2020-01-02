@include('layouts.layout')

<div class="container">
<a href="{{ url()->previous() }}" class="btn btn-warning mt-3">BACK</a>
<div class="row">
        <div class="col-12 mt-3 text-white">
                <h1>Add New Customer</h1>
        </div>
    
    </div>
    
    <div class="row">
        <div class="col-12">
    
             <form action="/" method ="POST" class="pb-5">
                <div class="form-group">
                        <label for="name" class="text-white mt-3">Name</label>
                        <div class=text-danger>{{$errors->first('name')}}</div>
                    <input type="text" placeholder = "Patient Name" name = "name" class="form-control" value = "{{old('name') ?? $patient->name}}" >
                        <hr>
                    </div class="form-group">
                    <label for="email" class="text-white">Telephone</label> 
                    <div>
                    <input type="text" placeholder = "Patient Telephone/Mob." name = "phone" value = "{{old('phone')?? $patient->phone}}" class="form-control">
                    <div class=text-danger>{{$errors->first('phone')}}</div>
                    </div>
                    <hr>
                    <hr>
                    <label for="" class="text-white">Doctors</label>
                    <div class="form-check">
                        @foreach ($users as $item)
                            <div class="ml-2">
                                
                                <input type="checkbox" value="{{$item->id}}" name="{{$item->id}}" class='form-check-input text-white' id='doctor'> 
                                <label for="doctor" class='form-check-label text-white'>{{$item->name}}</label>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    </div>

                
                    @csrf


                    {{-- <h1 class="text-white ml-5">{{$user->first()}}</h1> --}}
    
                <button type="submit" class="btn btn-primary ml-3"><strong>Add Patient</strong></button>
            </form>
        </div>
    </div>
</div>


