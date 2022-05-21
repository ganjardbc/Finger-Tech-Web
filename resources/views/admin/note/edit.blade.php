@extends('layouts.admin')
@section('content')
<script>
    var server = '{{ url("/") }}';

    function publish() {
		var fd = new FormData();

        var idnote = $('#idnote').val();
        var icon = '';
        var title = $('#title').val();
        var description = $('#description').val();
        var link = $('#link').val();
		var ctn = 1;
        var cover = $('#cover')[0].files[0];

        if (ctn > 0) {
            fd.append('cover', cover);
            fd.append('idnote', idnote);
            fd.append('icon', icon);
            fd.append('title', title);
            fd.append('description', description);
            fd.append('link', link);

            $.each($('#form-publish').serializeArray(), function(a, b) {
			   	fd.append(b.name, b.value);
			});

            $.ajax({
                url: '{{ url("/admin/note/put") }}',
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
                    window.location = server+'/admin/client';
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
			})
			.always(function () {
				//after done
			});
        } else {
            alert('Please set all field');
        }

		return false;
	}

    $(document).ready(function() {
        $("#description").on('keyup', function() {
            $('#display_count').text(this.value.length);
        });
    });
</script>

<div class="padding-top-20px"></div>

<h1 class="ctn-font ctn-small ctn-font-primary-bold ctn-min-color">Edit Klien</h1>

<form 
    id="form-publish" 
    method="post" 
    action="javascript:void(0)" 
    enctype="multipart/form-data" 
    onsubmit="publish()">
    <div class="content-create">
        <div class="cc-left">
        @foreach ($note as $sv)
            <input type="hidden" id="idnote" value="{{ $sv->idnote }}">
            <div class="cc-block">
                <div class="label">
                    Cover
                </div>
                <div class="desc">
                    <p>Pilih satu gambar</p>
                </div>
                <div class="padding-top-15px">
                    <div class="col-1">
                        <div
                            id="add-pict" 
                            class="image image-150px"
                            style="background-image: url({{ asset('/img/note/thumbnails/'.$sv->cover) }});"></div>
                    </div>
                    <div class="col-2">
                        <div class="padding-15px"></div>
                        <div class="position middle">
                            <input type="file" name="cover" id="cover">
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
                    class="txt txt-primary-color"
                    value="{{ $sv->title }}"
                    required="required"
                    placeholder="">
            </div>
            <div class="cc-block">
                <div class="label">
                    Deskripsi (opsional)
                </div>
                <div class="padding-bottom-5px">
                    <p class="ctn-font ctn-14px ctn-sek-color">
                        <span id="display_count">0</span>/250
                    </p>
                </div>
                <textarea 
                    name="deskripsi" 
                    id="description"
                    maxlength="250"
                    class="txt txt-primary-color edit-text">{{ $sv->description }}</textarea>
            </div>
            <div class="cc-block">
                <div class="label">
                    Link
                </div>
                <div class="desc">
                    <p>Gunakan link dari artikel ataupun tag dari galeri</p>
                </div>
                <input 
                    type="text"
                    name="link"
                    id="link"
                    value="{{ $sv->link }}" 
                    class="txt txt-primary-color"
                    placeholder="https://">
            </div>
        @endforeach
        </div>
        <div class="cc-right">
            <div class="cc-block bdr-all">
                <div class="label">
                    Catatan
                </div>
                <ul class="cc-note">
                    <li>Deskripsi bertipe opsional artinya boleh diisi boleh juga tidak</li>
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