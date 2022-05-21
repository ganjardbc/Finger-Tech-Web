<div class="width width-row-3">
    <div style="padding: 15px;">
        <div class="frm-article">
            <div style="padding: 30px;">
                <div 
                    class="image image-all image-radius"
                    style="
                        background-image: url({{ asset('/img/service/thumbnails/'.$dt->cover) }});
                        margin-bottom: 15px;
                    ">
                </div>
                <div class="content-description">
                    <h2 class="ctn-font ctn-14pt ctn-min-color ctn-font-primary-semibold" style="margin-bottom: 15px;">
                        {{ $dt->title }}
                    </h2>
                    <p class="ctn-font ctn-14pt ctn-min-color ctn-font-sekunder-thin">
                        {{ $dt->description }}
                    </p>
                </div>
                <div class="display-flex">
                    <a href="{{ url('/service/'.base64_encode($dt->idservice)) }}" class="btn btn-main-color">
                        Learn More <i class="icn icn-right fa fa-lg fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>