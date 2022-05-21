@extends('layouts.admin')
@section('content')
<script>
    var server = '{{ url("/") }}';

    function publish() {
		var fd = new FormData();

        var idimages = $('#idimages').val();
        var idowner = $('#idowner').val();
        var type = $('#type').val();
        var description = $('#description').val();
        var cover = $('#cover')[0].files[0];
		var ctn = 1;

        if (ctn > 0) {
            fd.append('cover', cover);
            fd.append('idimages', idimages);
            fd.append('idowner', idowner);
            fd.append('type', type);
            fd.append('description', description);

            $.each($('#form-publish').serializeArray(), function(a, b) {
			   	fd.append(b.name, b.value);
			});

            $.ajax({
                url: '{{ url("/admin/images/put") }}',
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
                    // window.location = server+'/admin/client';
                    goBack();
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

<h1 class="ctn-font ctn-small ctn-font-primary-bold ctn-min-color">Edit Detail</h1>

<form 
    id="form-publish" 
    method="post" 
    action="javascript:void(0)" 
    enctype="multipart/form-data" 
    onsubmit="publish()">
    <div class="content-create">
        <div class="cc-left">
            <input type="hidden" id="idimages" value="{{ $images->idimages }}">
            <input type="hidden" id="idowner" value="{{ $images->idowner }}">
            <input type="hidden" id="type" value="{{ $images->type }}">
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
                            style="background-image: url({{ asset('/img/images/thumbnails/'.$images->cover) }});"></div>
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
                    Deskripsi (opsional)
                </div>
                <div class="desc">
                    <p>
                        Gunakan kalimat yang jelas,
                        tidak berbelit-belit dan langsung ke poko bahasan.
                    </p>
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
                    class="txt txt-primary-color edit-text">{{ $images->description }}</textarea>
            </div>
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