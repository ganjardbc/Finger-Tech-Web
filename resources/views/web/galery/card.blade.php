<?php $path = asset('/img/galery/covers/'.$dt->cover); ?>

<div class="width width-row-3">
	<div style="padding: 15px;">
		<div class="frm-article">
			<div style="padding: 30px;">
				<div 
					onclick="opViewImage('{{ $dt->idgalery }}', '{{ $path }}')" 
					class="image image-full image-radius" 
					style="background-image: url({{ asset('/img/galery/thumbnails/'.$dt->cover) }}); cursor: pointer;">
				</div>
				<div style="padding-top: 30px; padding-bottom: 30px;">
					<h1 class="ctn-font ctn-14pt ctn-min-color ctn-font-primary-bold" style="margin-bottom: 15px;">{{ $dt->title }}</h1>
					<p class="ctn-font ctn-11pt ctn-sek-color">{{ $dt->description }}</p>
				</div>
				<button class="btn btn-main-color" onclick="opViewImage('{{ $dt->idgalery }}', '{{ $path }}')">
                    View Detail <i class="icn icn-right fa fa-lg fa-arrow-right"></i>
                </button>
			</div>
		</div>
	</div>
</div>
