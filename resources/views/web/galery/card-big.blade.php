<div class="frm-big-galery">

    <div class="place">
        @foreach ($galery as $dt)
            <div 
                class="image image-all" 
                style="background-image: url({{ asset('/img/galery/thumbnails/'.$dt->cover) }});"></div>
        @endforeach
    </div>

</div>