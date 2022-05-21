<div class="width width-row-3">
    <div style="padding: 15px;">
        <div class="frm-article">
            <div style="padding: 30px; text-align: center;">
                <div 
                    class="image image-100px image-circle image-center"
                    style="
                        background-image: url({{ asset('/img/testimony/thumbnails/'.$dt->photo) }});
                    ">
                </div>
                <div style="padding-top: 15px; padding-bottom: 15px;">
                    <div class="ctn-font ctn-14pt ctn-min-color ctn-font-primary-semibold" style="margin-bottom: 5px;">
                        {{ $dt->name }}
                    </div>
                    <div class="ctn-font ctn-12pt ctn-min-color ctn-font-sekunder-thin" style="margin-bottom: 15px;">
                        {{ $dt->job }}
                    </div>
                    <div class="ctn-font ctn-14pt ctn-min-color ctn-font-sekunder-thin">
                        <i>"{{ $dt->response }}"</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>