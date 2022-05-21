<div class="width width-row-4">
    <div class="padding-all-15px padding-left-mobile padding-right-mobile">
        <div class="frm-article bg-transparent no-border">
            <div style="padding: 30px 0;">
                <div 
                    class="image image-all image-radius"
                    style="
                        background-image: url({{ asset('/img/banner/thumbnails/'.$dt->cover) }});
                        margin-bottom: 15px;
                    ">
                </div>
                <div class="content-description">
                    <h2 
                        class="ctn-font ctn-14pt ctn-white-color ctn-font-primary-semibold" 
                        style="margin-bottom: 15px;">
                        {{ $dt->title }}
                    </h2>
                    <p class="ctn-font ctn-14pt ctn-white-color ctn-font-sekunder-thin">
                        {{ $dt->description }}
                    </p>
                </div>
                <div class="display-flex">
                    <a href="{{ url('/product/'.base64_encode($dt->idbanner)) }}" class="btn btn-main-color">
                        Learn More <i class="icn icn-right fa fa-lg fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>