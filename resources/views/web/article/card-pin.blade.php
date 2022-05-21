<div class="frm-article">
	<a href="{{ url('/article/'.base64_encode($dt->idarticle)) }}">
		<div class="cover big">
			<div class="type bg-color-1 type-circle">
				<span class="fa fa-lg fa-star"></span>
			</div>
            <div 
                class="image" 
                style="background-image: url({{ asset('/img/article/thumbnails/'.$dt->cover) }}"></div>
		</div>
	</a>
	<div class="content big">
		<div class="date">
			<span class="icn fa fa-lg fa-clock"></span>
			<span>{{ date_format(date_create($dt->date), "M d, Y") }}</span>
			<span class="icn fa fa-lg fa-user"></span>
			<span>{{ $dt->name }}</span>
		</div>
		<div class="ttl ctn-font ctn-18pt ctn-sek-color ctn-font-primary-light">
			<a href="{{ url('/article/'.base64_encode($dt->idarticle)) }}">
				{{ $dt->title }}
			</a>
		</div>
		<div class="more">
			<a href="{{ url('/article/'.base64_encode($dt->idarticle)) }}">
				<button class="btn btn-sekunder-color btn-radius">
					Read More
					<span class="fa fa-lg fa-angle-right"></span>
				</button>
			</a>
		</div>
	</div>
</div>