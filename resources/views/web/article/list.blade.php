@extends('layouts.web')
@section('title', $title)
@section('content')

<div class="body-block">
    <div class="banner-container">
        <div class="main-container display-flex space-between align-center display-mobile">
            <div class="width width-50 width-mobile">
                <div class="width width-100 width-mobile">
                    <div>
                        <h2 class="ctn-font ctn-32pt ctn-white-color ctn-font-primary-semibold ctn-small-line" style="margin: 15px 0;">
                            ARTICLES
                        </h2>
                        <p class="ctn-font ctn-14pt ctn-white-color ctn-line ctn-font-sekunder-thin">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.
                        </p>
                    </div>
                </div>
            </div>
            <div class="width width-50 width-mobile"></div>
        </div>
    </div>

    <div class="main-container-medium">
        @if (count($article) != 0)
            <div class="display-flex display-mobile align-left wrap">
                @foreach ($article as $key => $dt)
                    @include('web.article.card-small')
                @endforeach
            </div>
            <div class="bot padding-top-10px">
                <div>
                    {{ $article->links() }}
                </div>
            </div>
        @else
            <div class="top">
                <h1 class="ctn-font ctn-font-primary-light ctn-thin ctn-18pt ctn-min-color">
                    Articles still empty
                </h1>
            </div>
        @endif 
    </div> 
</div>

@endsection