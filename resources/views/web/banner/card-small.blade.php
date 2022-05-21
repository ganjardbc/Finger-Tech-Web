<div class="frm-small-article {{ ($key % 2 > 0) ? 'reverse' : '' }}">
	<div class="cover">
		<div 
			class="image" 
			style="background-image: url({{ asset('/img/banner/thumbnails/'.$dt->cover) }}"></div>
	</div>
	<div class="content">
		<div class="post-top">
			<div class="ttl">
				{{ $dt->title }}
			</div>
			<div class="dsc" style="margin-bottom: 30px;">
                {{ $dt->description }}
            </div>
			<div class="display-flex">
				<a href="{{ url('/product/'.base64_encode($dt->idbanner)) }}" class="btn btn-main-color">
					Learn More <i class="icn icn-right fa fa-lg fa-arrow-right"></i>
				</a>
			</div>
		</div>
	</div>
</div>