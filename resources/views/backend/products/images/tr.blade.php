<tr>
    <td>
        {{$image->image}}
    </td>
    <td>
        <img src="/{{'images/'.$image->image}}" alt="" style="width: 5vw;">
    </td>
    <td>
        {{round(Intervention\Image\Facades\Image::make('images/'.$image->image)->filesize()/1024, 1)}} KB
    </td>
    <td class="text-center">
        <a href="#" rel="tooltip"
           class="btn-lg btn-success btn-icon btn-sm btn-optimize-image" data-id="{{$image->id}}"
           title="">
            <i class="fa fa-cog fa-spin"></i>
        </a>
    </td>
</tr>
