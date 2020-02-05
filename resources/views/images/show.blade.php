@include('layouts.layout')

<div class="container">
    <form action={{ url()->previous() }}>
        <button type="submit" class="btn btn-warning mt-3 ml-1">BACK</button>
    </form>
    {{-- <form action="/patients/{{$patient}}/diagnoses/{{$diagnosis}}/images">
        <button type="submit" class="btn btn-warning mt-3 ml-1">BACK</button>
    </form> --}}

    <hr>

    <div class="row">
        @foreach ($images as $img)
        @if ($img->id == $image)
        <div class="col-12 mb-4 text-center">
        <a href="{{ asset('storage/' . $img->image)}}"><img src="{{ asset('storage/' . $img->image)}}" alt="" class="img-fluid max-width: 100% height: auto;"></a>
        
                <form action="/images/{{$img->id}}" method='post'>
                    @method('DELETE')
                    @csrf
    
                    <button class="small btn btn-outline-danger btn-light mt-3 font-weight-bold">Delete</button>
                </form>
        </div>
        @endif
        @endforeach  
    </div>
    </div>
</div>

