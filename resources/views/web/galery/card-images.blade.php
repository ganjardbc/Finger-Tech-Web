<?php $path = asset('/img/images/covers/'.$dt->cover); ?>

<div class="width width-row-2">
    <div style="padding: 15px;">
        <div 
            onclick="opViewImage('{{ $dt->idimages }}', '{{ $path }}')" 
            class="image image-full image-radius image-hover" 
            style="background-image: url({{ asset('/img/images/thumbnails/'.$dt->cover) }}); cursor: pointer;">
            <div class="img-caption">
                <p class="ctn-font ctn-14pt ctn-white-color">{{ $dt->description }}</p>
            </div>
        </div>
    </div>
</div>