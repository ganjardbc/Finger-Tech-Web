<script>
    function clViewImage()
    {
        $('#image-popup').fadeOut();
    }
    function opViewImage(id, path, desc)
    {
        var img = path;
        
        $('#image-popup')
        .fadeIn();

        $('#image-popup')
        .find('.img')
        .attr('src', img)

        $('#image-popup')
        .find('.desc')
        .text(desc);
    }
</script>
<div class="frm-popup" id="image-popup">
    <div class="fp-place">
        <div class="fp-mid">
            <div class="close">
                <button 
                    class="btn btn-transparent-color btn-circle" 
                    onclick="clViewImage()">
                    <span class="fa fa-lg fa-times"></span>
                </button>
            </div>
            <div class="galery">
                <img src="" class="img">
            </div>
        </div>
    </div>
</div>