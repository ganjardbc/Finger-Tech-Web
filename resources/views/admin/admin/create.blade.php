@extends('layouts.admin')
@section('content')

<div class="padding-top-20px"></div>

<h1 class="ctn-font ctn-small ctn-font-primary-bold ctn-min-color">Tambah Admin</h1>

<form method="POST" action="{{ url('/admin/admin/publish') }}">
    @csrf
    <div class="content-create">
        <div class="cc-left">
            <div class="cc-block">
                <div class="label">
                    Nama
                </div>
                <input 
                    type="text"
                    name="name"
                    id="name"
                    class="txt txt-primary-color"
                    required="required"
                    placeholder="">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="cc-block">
                <div class="label">
                    Email
                </div>
                <input 
                    type="email"
                    name="email"
                    id="email"
                    class="txt txt-primary-color"
                    required="required"
                    placeholder="">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="cc-block">
                <div class="label">
                    Password
                </div>
                <input 
                    type="password"
                    name="password"
                    id="password"
                    class="txt txt-primary-color"
                    required="required"
                    placeholder="">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="cc-block">
                <div class="label">
                    Konfirmasi Password
                </div>
                <input 
                    type="password"
                    name="password_confirm"
                    id="password_confirm"
                    class="txt txt-primary-color"
                    required="required"
                    placeholder="">
            </div>
        </div>
        <div class="cc-right">
            <div class="cc-block bdr-all">
                <div class="label">
                    Catatan
                </div>
                <ul class="cc-note">
                    <li>Isi semua field dengan data yang benar dan sesungguhnya</li>
                </ul>
            </div>
            <div class="cc-block">
                <input 
                    type="submit" 
                    value="Simpan"
                    class="btn btn-main-color">
            </div>
            <div class="cc-block">
                <input 
                    type="button" 
                    value="Cancel"
                    onclick="goBack()" 
                    class="btn btn-sekunder-color">
            </div>
        </div>
    </div>
</form>

@endsection