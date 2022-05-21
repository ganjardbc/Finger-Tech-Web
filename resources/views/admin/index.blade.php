@extends('layouts.admin')
@section('content')
<script type="text/javascript">
    (function(w,d,s,g,js,fs){
      g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
      js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
      js.src='https://apis.google.com/js/platform.js';
      fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
    }(window,document,'script'));
</script>

<div class="main-page">
    <div id="embed-api-auth-container"></div>
    <div id="chart-container"></div>
    <div id="view-selector-container"></div>
</div>

<script>

gapi.analytics.ready(function() {

  /**
   * Authorize the user immediately if the user has already granted access.
   * If no access has been created, render an authorize button inside the
   * element with the ID "embed-api-auth-container".
   */
  gapi.analytics.auth.authorize({
    container: 'embed-api-auth-container',
    clientid: 'REPLACE WITH YOUR CLIENT ID'
  });


  /**
   * Create a new ViewSelector instance to be rendered inside of an
   * element with the id "view-selector-container".
   */
  var viewSelector = new gapi.analytics.ViewSelector({
    container: 'view-selector-container'
  });

  // Render the view selector to the page.
  viewSelector.execute();


  /**
   * Create a new DataChart instance with the given query parameters
   * and Google chart options. It will be rendered inside an element
   * with the id "chart-container".
   */
  var dataChart = new gapi.analytics.googleCharts.DataChart({
    query: {
      metrics: 'ga:sessions',
      dimensions: 'ga:date',
      'start-date': '30daysAgo',
      'end-date': 'yesterday'
    },
    chart: {
      container: 'chart-container',
      type: 'LINE',
      options: {
        width: '100%'
      }
    }
  });


  /**
   * Render the dataChart on the page whenever a new view is selected.
   */
  viewSelector.on('change', function(ids) {
    dataChart.set({query: {ids: ids}}).execute();
  });

});
</script>

<div class="main-page mp-3 padding-top-15px">

    <div class="frm-main-page">
        <a href="{{ url('/admin/product') }}">
            <div class="fmp-top">
                <div class="icn fa fa-lg fa-camera"></div>
            </div>
        </a>
        <div class="fmp-mid">
            Produk
        </div>
    </div>

    <div class="frm-main-page">
        <a href="{{ url('/admin/service') }}">
            <div class="fmp-top">
                <div class="icn fa fa-lg fa-lightbulb"></div>
            </div>
        </a>
        <div class="fmp-mid">
            Konten & Layanan
        </div>
    </div>

    <div class="frm-main-page">
        <a href="{{ url('/admin/portofolio') }}">
            <div class="fmp-top">
                <div class="icn fa fa-lg fa-images"></div>
            </div>
        </a>
        <div class="fmp-mid">
            Portofolio
        </div>
    </div>    

</div>
<div class="main-page mp-3">

    <div class="frm-main-page">
        <a href="{{ url('/admin/article') }}">
            <div class="fmp-top">
                <div class="icn fa fa-lg fa-edit"></div>
            </div>
        </a>
        <div class="fmp-mid">
            Artikel & Blog
        </div>
    </div>

    <div class="frm-main-page">
        <a href="{{ url('/admin/client') }}">
            <div class="fmp-top">
                <div class="icn far fa-lg fa-sticky-note"></div>
            </div>
        </a>
        <div class="fmp-mid">
            Klien
        </div>
    </div>

    <div class="frm-main-page">
        <a href="{{ url('/admin/testimony') }}">
            <div class="fmp-top">
                <div class="icn fa fa-lg fa-quote-left"></div>
            </div>
        </a>
        <div class="fmp-mid">
            Testimonial
        </div>
    </div>

</div>
<div class="main-page mp-3 padding-bottom-15px">

    <div class="frm-main-page">
        <a href="{{ url('/admin/contact') }}">
            <div class="fmp-top">
                <div class="icn fa fa-lg fa-id-card"></div>
            </div>
        </a>
        <div class="fmp-mid">
            Kontak Pelanggan
        </div>
    </div>

    <div class="frm-main-page">
        <a href="{{ url('/admin/admin') }}">
            <div class="fmp-top">
                <div class="icn fa fa-lg fa-users"></div>
            </div>
        </a>
        <div class="fmp-mid">
            Pengelolaan Admin
        </div>
    </div>

    <div class="frm-main-page">
        <a href="{{ url('/admin/admin/edit') }}">
            <div class="fmp-top">
                <div class="icn fa fa-lg fa-cog"></div>
            </div>
        </a>
        <div class="fmp-mid">
            Akun Admin
        </div>
    </div>

</div>
@endsection