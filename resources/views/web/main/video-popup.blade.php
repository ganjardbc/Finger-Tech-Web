<script type="text/javascript">
    function opVideo(stt) {
        var dt = '';
        if (stt == 'show') {
            $('#video-popup').fadeIn();
            $('#video-place').html(dt);
        } else {
            $('#video-popup').fadeOut();
            $('#video-place').html('');
        }
    }
</script>
<div class="frm-popup" id="video-popup">
    <div class="fp-place">
        <div class="close">
            <button 
                class="btn btn-main-color btn-radius" 
                onclick="opVideo('hide')">
                <span class="fa fa-lw fa-times"></span>
                <span>Close</span>
            </button>
        </div>
        <div class="fp-mid">
            <div class="vid" id="video-place"></div>
        </div>
    </div>
</div>