@extends('layouts.admin')
@section('content')
<script>
    var server = '{{ url("/") }}';

    function publish() {
		var fd = new FormData();

        var ctn = 1;
        var cover = $('#cover')[0].files[0];
        var idtestimony = $('#idtestimony').val();
        var name = $('#name').val();
        var job = $('#job').val();
        var response = $('#description').val();

        if (ctn > 0) {
            fd.append('cover', cover);
            fd.append('idtestimony', idtestimony);
            fd.append('name', name);
            fd.append('job', job);
            fd.append('response', response);

            $.each($('#form-publish').serializeArray(), function(a, b) {
			   	fd.append(b.name, b.value);
			});

            $.ajax({
                url: '{{ url("/admin/testimony/put") }}',
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
                    window.location = server+'/admin/testimony';
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
            alert('Please select one photo');
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

<h1 class="ctn-font ctn-small ctn-font-primary-bold ctn-min-color">Edit Testimony</h1>

<form 
    id="form-publish" 
    method="post" 
    action="javascript:void(0)" 
    enctype="multipart/form-data" 
    onsubmit="publish()">
    <div class="content-create">
        <div class="cc-left">
        @foreach ($testimony as $tt)
            <input type="hidden" id="idtestimony" value="{{ $tt->idtestimony }}">

            <div class="cc-block">
                <div class="label">
                    Foto Profil
                </div>
                <div class="desc">
                    <p>Pilih satu gambar</p>
                </div>
                <div class="padding-top-15px">
                    <div class="col-1">
                        <div
                            id="add-pict" 
                            class="image image-150px image-circle"
                            style="background-image: url({{ asset('/img/testimony/thumbnails/'.$tt->photo) }});"></div>
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
                    Nama Lengkap
                </div>
                <input 
                    type="text"
                    name="name"
                    class="txt txt-primary-color"
                    id="name"
                    required="required"
                    value="{{ $tt->name }}"
                    placeholder="">
            </div>

            <div class="cc-block">
                <div class="label">
                    Pekerjaan
                </div>
                <input 
                    type="text"
                    name="job"
                    class="txt txt-primary-color"
                    id="job"
                    required="required"
                    value="{{ $tt->job }}"
                    placeholder="">
            </div>

            <div class="cc-block">
                <div class="label">
                    Respon atau testimoni
                </div>
                <div class="padding-bottom-5px">
                    <p class="ctn-font ctn-14px ctn-sek-color">
                        <span id="display_count">0</span>/250
                    </p>
                </div>
                <textarea 
                    name="description" 
                    id="description"
                    class="txt txt-primary-color edit-text"
                    required="required"
                    maxlength="250">{{ $tt->response }}</textarea>
            </div>
        @endforeach
        </div>
        <div class="cc-right">
            <div class="cc-block bdr-all">
                <div class="label">
                    Catatan
                </div>
                <ul class="cc-note">
                    <li>Testimoni wajib menggunakan Foto Profil.</li>
                    <li>
                        Testimoni bisa diambil dari respon atau komentar
                        dari berbagai macam platform sperti Instagram,
                        TripAdvisor, Google+ dsb.
                    </li>
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