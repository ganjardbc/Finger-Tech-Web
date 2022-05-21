<div 
	onclick="opViewImage('{{ $tg->id }}', '{{ $tg->images->standard_resolution->url }}')"
    class="frm-instagram" 
	style="background-image: url({{ $tg->images->low_resolution->url }})">
	<div class="desc">
		<div class="ttl">{{ $tg->caption->text }}</div>
	</div>
</div>