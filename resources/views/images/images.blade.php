@include('layouts.layout')


<div class="container">

    <form action="/patients/{{$diagnosis}}/diagnoses/{{$patient}}">
        <button type="submit" class="btn btn-warning mt-3 ml-1">BACK</button>
    </form>

<hr>
    <div class="row mt-3">
        
        <div class="col-4">

        </div>
        
        <div class="col-4 rounded py-2 my-2 mb-4 mt-3 bg-primary">
            <form action="/images/create" method ="POST" class="" enctype="multipart/form-data" >
                @csrf
                <input type="file" name = "image" class="text-white pt-2 pr-5 mb-1 w-100 h-100" onchange="form.submit()">
                <input type="hidden" name="diagnosis_id" value="{{$patient}}">
                <div class=text-danger>{{$errors->first('image')}}</div>
            </form>
        
        </div>
    
        
        <div class="col-4"></div>
        
    
    </div>

    <hr>

    {{-- <div class="row">
            @foreach ($images as $img)
            @if ($img->diagnosis_id == $patient)
            <div class="col-3 mb-4">
            <a href="{{ asset('storage/' . $img->image)}}"><img src="{{ asset('storage/' . $img->image)}}" alt="" class="w-100"></a>

                    <form action="/images/{{$img->id}}" method='post'>
                        @method('DELETE')
                        @csrf

                        <button class="small btn btn-outline-danger btn-light mt-2 font-weight-bold">Delete</button>
                    </form>
            </div>
            @endif
            @endforeach  
    </div> --}}

    <div class="row">
            @foreach ($images as $img)
            @if ($img->diagnosis_id == $patient)
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
            <a href="{{ url('patients/' . $diagnosis . " /diagnoses/" . $patient . " /images/" . $img->id)}}"><img src="{{ asset('storage/' . $img->image)}}" alt="" class="w-100 rounded float-left"></a>
            
                    <form action="/images/{{$img->id}}" method='post'>
                        @method('DELETE')
                        @csrf

                        <button class="small btn btn-outline-danger btn-light mt-2 font-weight-bold">Delete</button>
                    </form>
            </div>
            @endif
            @endforeach  
    </div>
</div>
{{-- </div> --}}




{{-- <script src="{{ mix('js/app.js')}}"></script> --}}


</body>
</html>



