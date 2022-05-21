<div class="frm-small-article {{ ($key % 2 > 0) ? 'reverse' : '' }}">
	<div class="cover">
		<div 
			class="image" 
			style="background-image: url({{ asset('/img/article/thumbnails/'.$dt->cover) }}"></div>
	</div>
	<div class="content">
		<div class="post-top">
			<div class="ttl">
				{{ $dt->title }}
			</div>
			<div class="date" style="margin-top: 15px; margin-bottom: 30px;">
				<span class="icn fa fa-lg fa-clock"></span>
				<span>{{ date_format(date_create($dt->date), "M d, Y") }}</span>
				<span class="icn fa fa-lg fa-user" style="margin-left: 10px;"></span>
				<span>{{ $dt->name }}</span>
			</div>
			<div class="display-flex">
				<a href="{{ url('/article/'.base64_encode($dt->idarticle)) }}" class="btn btn-main-color">
					Read More <i class="icn icn-right fa fa-lg fa-arrow-right"></i>
				</a>
			</div>
		</div>
	</div>
</div>