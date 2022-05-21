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
        var tags = $('#tags').val();

        if (ctn > 0) {
            fd.append('cover', cover);
            fd.append('title', title);
            fd.append('description', description);
            fd.append('tags', tags);

            $.each($('#form-publish').serializeArray(), function(a, b) {
			   	fd.append(b.name, b.value);
			});

            $.ajax({
                url: '{{ url("/admin/galery/publish") }}',
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
                    window.location = server+'/admin/galery';
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
				//loadPopup('hide');
			});
        } else {
            alert('Please select one cover');
        }

		return false;
	}
</script>

<div class="padding-top-20px"></div>

<h1 class="ctn-font ctn-small ctn-font-primary-bold ctn-min-color">Tambah Portofolio</h1>

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
                <div class="desc">
                    <p>Pilih satu gambar</p>
                </div>
                <div class="padding-top-15px">
                    <div class="col-1">
                        <div
                            id="add-pict" 
                            class="image image-150px"></div>
                    </div>
                    <div class="col-2">
                        <div class="padding-15px"></div>
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
            <div class="cc-block">
                <div class="label">
                    Tags (opsional)
                </div>
                <div class="desc">
                    Tiap tagging dipisahkan dengan 'koma'
                </div>
                <input 
                    type="text"
                    name="tags"
                    id="tags"
                    class="txt txt-primary-color"
                    placeholder="Tags 1, Tags 2, Tags 3">
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