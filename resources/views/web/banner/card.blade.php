<div class="width width-row-3">
    <div style="padding: 15px;">
        <div class="frm-article">
            <div style="padding: 30px;">
                <a href="{{ url('/product/'.base64_encode($dt->idbanner)) }}">
                    <div 
                        class="image image-all image-radius"
                        style="
                            background-image: url({{ asset('/img/banner/thumbnails/'.$dt->cover) }});
                            margin-bottom: 15px;
                        ">
                    </div>
                </a>
                <div class="content-description">
                    <div class="ctn-font ctn-14pt ctn-min-color ctn-font-primary-bold" style="margin-bottom: 15px;">
                        {{ $dt->title }}
                    </div>
                    <div class="ctn-font ctn-11pt ctn-sek-color">
                        {{ $dt->description }}
                    </div>
                </div>
                <button class="btn btn-main-color">
                    Learn More <i class="icn icn-right fa fa-lg fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>