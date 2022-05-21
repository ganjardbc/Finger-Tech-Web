@extends('layouts.admin')
@section('content')

<link href="{{ asset('/summernote/dist/summernote-lite.css') }}" rel="stylesheet">
<script src="{{ asset('/summernote/dist/summernote-lite.js') }}"></script>

<script>
    var server = '{{ url("/") }}';

    function publish() {
        var fd = new FormData();

        var ctn = $('#cover')[0].files.length;
        var cover = $('#cover')[0].files[0];
        var title = $('#title').val();
        var content = $('#content').val();
        var service = $('#service').val();
        var status = $('input[name=status]:checked').val();

        if (ctn > 0) {
            fd.append('cover', cover);
            fd.append('title', title);
            fd.append('content', content);
            fd.append('service', service);
            fd.append('status', status);

            $.each($('#form-publish').serializeArray(), function(a, b) {
                fd.append(b.name, b.value);
            });

            $.ajax({
                url: '{{ url("/admin/article/publish") }}',
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'post',
                beforeSend: function() {
                    loadPopup('show');
                }
            })
            .done(function(data) {
                if (data.status == 'success') 
                {
                    window.location = server+'/admin/article';
                } 
                else 
                {
                    loadPopup('hide');
                    alert(data.message);
                }
            })
            .fail(function(data) {
                loadPopup('hide');
                alert(data.responseJSON.message);
                //console.log(data.responseJSON);
            })
            .always(function () {
                //after done
            });
        } else {
            alert('Please select one cover');
        }

        return false;
    }
    $(document).ready(function () {
        $('#content').summernote({
            minHeight: 300,
            required: true
        });
    });
</script>

<div class="padding-top-20px"></div>

<h1 class="ctn-font ctn-small ctn-font-primary-bold ctn-min-color">Buat Artikel</h1>

<form 
    id="form-publish" 
    method="post" 
    action="javascript:void(0)" 
    enctype="multipart/form-data" 
    onsubmit="publish()">
    <div class="content-create">
        <div class="cc-left">
            <div class="cc-block">
                <div class="label">
                    Cover
                </div>
                <div class="grid">
                    <div class="col-1 padding-bottom-10px">
                        <div
                            id="add-pict" 
                            class="image image-full"
                            style="
                                margin: auto;
                                "></div>
                    </div>
                    <div class="col-1 padding-top-20px">
                        <div class="position middle">
                            <input type="file" name="cover" id="cover" required="required">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="cc-block">
                <div class="label">
                    Judul
                </div>
                <input 
                    type="text"
                    name="title"
                    id="title"
                    required="required"
                    class="txt txt-primary-color"
                    placeholder="">
            </div>

            <div class="cc-block">
                <div class="label">
                    Konten Artikel
                </div>
                <div class="desc">
                    Berisi konten dari artikel ataupun blog yang akan dibuat
                </div>
                <textarea 
                    name="content" 
                    id="content"
                    required="required"
                    class="txt txt-primary-color edit-text"></textarea>
            </div>

        </div>

        <div class="cc-right">

            <div class="cc-block bdr-all">
                <div class="label">
                    Catatan
                </div>
                <ul class="cc-note">
                    <li>Artikel wajib menggunakan cover yaitu gambar</li>
                    <li>Judul dan konten tidak boleh dikosongkan</li>
                    <li>
                        Versi text editor ini belum bisa mengupload gambar
                        dari device, jadi jangan dulu memasukan gambar
                        kecuali gambar dari internet.
                    </li>
                </ul>
            </div>

            <div class="cc-block bdr-all">
                <div class="label">
                        Status Artikel
                </div>
                <div class="padding-bottom-10px">
                    <ul class="cc-note">
                        <li>
                            Jika ingin menyimpan artikel ke dalam "Draft" terlebih dahulu, pilih "Draft".
                        </li>
                        <li>
                            Jika ingin langsung mempublish langsung artikel, pilih "Publish".
                        </li>
                    </ul>
                </div>
                <div class="rd" id="status">
                    <input type="radio" name="status" value="1" checked>
                    <label for="status">Draft</label>
                    <br>
                    <input type="radio" name="status" value="0">
                    <label for="status">Publish</label>
                </div>
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

        <div class="padding-10px"></div>
    </div>
</form>

@endsection
