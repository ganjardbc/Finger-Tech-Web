@extends('layouts.web')
@section('title', $title)
@section('content')

<?php 
    $src = $_GET['src'];
    $trg = $_GET['nav'];
    if ($trg == 'article') {
        $nav = '#nav-article';
    }
    if ($trg == 'portofolio') {
        $nav = '#nav-galery';
    }
?>

<script>
    $(document).ready(function () {
        $('{{ $nav }}').addClass('active');
    });
</script>

<div class="body-block">
    <div class="banner-container">
        <div class="main-container display-flex space-between align-center display-mobile">
            <div class="width width-50 width-mobile">
                <div class="width width-100 width-mobile">
                    <div>
                        <h2 class="ctn-font ctn-32pt ctn-white-color ctn-font-primary-semibold ctn-small-line" style="margin: 15px 0;">
                            Key words "{{ $src }}"
                        </h2>
                        <p class="ctn-font ctn-14pt ctn-white-color ctn-line ctn-font-sekunder-thin">
                            Result for articles or portofolios.
                        </p>
                    </div>
                </div>
            </div>
            <div class="width width-50 width-mobile"></div>
        </div>
    </div>

    <div class="main-container">
        <div class="padding-bottom-20px">
            <ul class="navigator">
                <a href="{{ url('/search?nav=article&src='.$src) }}">
                    <li class="left" id="nav-article">Articles</li>
                </a>
                <a href="{{ url('/search?nav=portofolio&src='.$src) }}">
                    <li class="right" id="nav-galery">Portofolios</li>
                </a>
            </ul>
        </div>

        @if ($trg == 'article')
            @if (count($search) != 0)
                <div class="display-flex display-mobile align-left wrap">
                    @foreach ($search as $dt)
                        @include('web.article.card')
                    @endforeach
                </div>
            @else
                <div class="display-flex center padding-top-20px">
                    <h1 class="ctn-font ctn-font-primary-light ctn-thin ctn-18pt ctn-min-color">
                        Articles Not Found
                    </h1>
                </div>
            @endif
        @endif

        @if ($trg == 'portofolio')
            @if (count($search) != 0)
                <div class="display-flex display-mobile align-left wrap">
                    @foreach ($search as $dt)
                        @include('web.galery.card')
                    @endforeach
                </div>
            @else
                <div class="display-flex center padding-top-20px">
                    <h1 class="ctn-font ctn-font-primary-light ctn-thin ctn-18pt ctn-min-color">
                        Galeries Not Found
                    </h1>
                </div>
            @endif
        @endif
    </div>
</div>

@endsection