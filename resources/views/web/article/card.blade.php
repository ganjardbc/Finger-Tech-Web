<div class="width width-row-3">
	<div style="padding: 15px;">
		<div class="frm-article">
			<div style="padding: 30px;">
				<a href="{{ url('/article/'.base64_encode($dt->idarticle)) }}">
					<div class="cover big">
						<div 
							class="image image-radius" 
							style="background-image: url({{ asset('/img/article/thumbnails/'.$dt->cover) }}"></div>
					</div>
				</a>
				<div style="padding-top: 15px; padding-bottom: 15px;">
					<a 
						class="ttl ctn-font ctn-14pt ctn-min-color ctn-font-primary-bold" 
						href="{{ url('/article/'.base64_encode($dt->idarticle)) }}">
						{{ $dt->title }}
					</a>
				</div>
				<button class="btn btn-main-color">
                    Read More <i class="icn icn-right fa fa-lg fa-arrow-right"></i>
                </button>
			</div>
		</div>
	</div>
</div>