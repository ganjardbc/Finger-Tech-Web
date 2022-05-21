<script type="text/javascript">
    function opSearch(stt) {
        if (stt == 'show') {
            $('#search-popup').fadeIn();
            $('#src').focus();
        } else {
            $('#search-popup').fadeOut();
        }
    }
</script>
<div class="frm-popup" id="search-popup">
    <div class="fp-place">
        <div class="close">
            <button 
                class="btn btn-transparent-color btn-circle" 
                onclick="opSearch('hide')">
                <span class="fa fa-lg fa-times"></span>
            </button>
        </div>
        <div class="fp-mid">
            <div class="search">
                <h2 class="ctn-font ctn-font-primary-light ctn-thin ctn-18pt ctn-sek-color" 
                    style="
                        text-align: center;
                        color: #fff;
                        padding-bottom: 10px;
                        font-weight: 500;
                    ">
                    Search articles or portofolios
                </h2>
                <form action="{{ url('/search') }}" method="get">
                    <input type="hidden" name="nav" value="article">
                    <input 
                        type="text" 
                        name="src" 
                        id="src" 
                        placeholder="Press enter to continue" 
                        required="required">
                </form>
            </div>
        </div>
    </div>
</div>