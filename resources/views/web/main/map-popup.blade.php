<script type="text/javascript">
	function opMap(stt) 
	{  
        var data = '\
            <iframe \
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2801.231154216802!2d107.63726792387176!3d-6.825771055646161!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e0f367d63315%3A0xac823530fc733ca6!2sKebun+Begonia!5e0!3m2!1sid!2sid!4v1535613699402" \
                width="1000" \
                height="500" \
                frameborder="0" \
                style="border:0" \
                allowfullscreen></iframe>\
        ';
        if (stt == 'show') 
        {
        	$('#map-popup').fadeIn();
        	$('#placeMap').html(data);
        } 
        else 
        {
        	$('#map-popup').fadeOut();
        	$('#placeMap').html('');
        }
    }
</script>
<div class="frm-popup" id="map-popup">
    <div class="fp-place">
        <div class="close">
            <button 
                class="btn btn-transparent-color btn-circle" 
            	onclick="opMap('hide')">
                <span class="fa fa-lg fa-times"></span>
            </button>
        </div>
        <div class="fp-mid">
            <div class="map" id="placeMap"></div>
        </div>
    </div>
</div>