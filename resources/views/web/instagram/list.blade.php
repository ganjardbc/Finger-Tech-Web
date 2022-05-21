@extends('layouts.web')
@section('content')

@include('web.main.image-popup')

<div class="body-padding"></div>

<div class="body-block">
    <div class="top">
        <p class="desc">Instagram</p>
        <h1 class="title">
            Kiriman di instagram oleh Kebun Begonia Lembang
        </h1>
        <div class="bdr"></div>
    </div>
    <div class="mid">
            
        <div class="place-more">
            <div class="cen" id="gc-1">
                @foreach ($insta as $tg)
                    @include('web.instagram.card')
                @endforeach
            </div>
        </div>

    </div>
    <div class="bot padding-20px">
        <div style="text-align: center;" class="padding-top-20px">
            <a href="https://instagram.com" target="_blank">
                <input 
                    type="button" 
                    value="Kunjungi Instagram Kami" 
                    class="btn btn-sekunder-color btn-radius">
            </a>
        </div>
    </div>
</div>

@endsection