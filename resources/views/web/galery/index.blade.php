@extends('layouts.web')
@section('title', $title)
@section('content')

<div class="body-block">
    <div class="banner-container">
        <div class="main-container display-flex space-between align-center display-mobile row-reverse">
            <div class="width width-30 width-mobile">
                <div 
                    class="image image-full image-radius"
                    style="
                        background-image: url({{ asset('/img/galery/thumbnails/'.$gallery->cover) }});
                    ">
                </div>
            </div>
            <div class="width width-60 width-mobile">
                <div class="width width-100 width-mobile">
                    <div>
                        <h2 class="ctn-font ctn-32pt ctn-white-color ctn-font-primary-semibold ctn-small-line" style="margin: 15px 0;">
                            {{ $gallery->title }}
                        </h2>
                        <p class="ctn-font ctn-14pt ctn-white-color ctn-line ctn-font-sekunder-thin">
                            {{ $gallery->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="display-flex left display-mobile wrap">
            @foreach($images as $key => $dt)
                @include('web.galery.card-images')
            @endforeach
        </div>
    </div>
</div>

@endsection