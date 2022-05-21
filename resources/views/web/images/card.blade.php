<div class="frm-small-article {{ ($key % 2 > 0) ? 'reverse' : '' }}">
    <div class="cover">
        <div 
            class="image" 
            style="background-image: url({{ asset('/img/images/thumbnails/'.$dt->cover) }}"></div>
    </div>
    <div class="content">
        <div class="post-top">
            <div class="ctn-font ctn-16pt ctn-min-color" style="margin-bottom: 30px;">
                {{ $dt->description }}
            </div>
        </div>
    </div>
</div>