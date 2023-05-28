@foreach($images as $image)
    <div class="col-md-3">
         <a  href="{{ $image->photo }}" data-fancybox data-caption="{{ $album->name }}">
             <img src="{{ $image->photo }}" style="width: auto; height:180px; margin:0.5px" />
        </a>
    </div>
@endforeach