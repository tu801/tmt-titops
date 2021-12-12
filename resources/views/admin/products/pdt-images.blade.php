@foreach( $images as $img )
    <img src="{{ asset('storage/uploads/products/'.$img->name) }}" class="col-3 img-thumb mb-2"  />
@endforeach