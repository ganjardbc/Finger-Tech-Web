@extends('layouts.admin')
@section('content')

<script>
    var server = '{{ url("/") }}';

    function publish() {
		var fd = new FormData();

        var ctn = $('#cover')[0].files.length;
        var cover = $('#cover')[0].files[0];
		var title = $('#title').val();
        var description = $('#description').val();
        var link = '';
        var position = 'center';

        if (ctn > 0) {
            fd.append('cover', cover);
            fd.append('title', title);
            fd.append('description', description);
            fd.append('link', link);
            fd.append('position', position);

            $.each($('#form-publish').serializeArray(), function(a, b) {
			   	fd.append(b.name, b.value);
			});

            $.ajax({
                url: '{{ url("/admin/banner/publish") }}',
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
                    window.location = server+'/admin/product';
                } 
                else 
                {
                    loadPopup('hide');
                    alert(data.message);
                }
			})
			.fail(function(data) {
                loadPopup('hide');
			   	console.log(data.responseJSON);
			})
			.always(function () {
				//after done
			});
        } else {
            alert('Please select one cover');
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

<h1 class="ctn-font ctn-small ctn-font-primary-bold ctn-min-color">Buat Produk</h1>

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
                            class="image image-150px"
                        ></div>
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
                    required="required"
                    class="txt txt-primary-color"
                    id="title"
                    placeholder="">
            </div>
            <div class="cc-block">
                <div class="label">
                    Deskripsi
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
                    maxlength="250"></textarea>
            </div>
        </div>
        <div class="cc-right">
            <div class="cc-block bdr-all">
                <div class="label">
                    Catatan
                </div>
                <ul class="cc-note">
                    <li>Jika judul, deskripsi dan link dikosongkan maka yang dimunculkan hanya gambar saja</li>
                    <li>Judul, deskripsi dan link bertipe opsional artinya boleh diisi boleh juga tidak</li>
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