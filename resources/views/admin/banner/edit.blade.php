@extends('layouts.admin')
@section('content')

<script>
    var server = '{{ url("/") }}';

    function publish() {
		var fd = new FormData();
        
        var idbanner = $('#idbanner').val();
        var title = $('#title').val();
		var description = $('#description').val();
        var link = '';
        var position = 'center';
        var cover = $('#cover')[0].files[0];
		var ctn = $('#cover')[0].files.length;

        if (ctn > 0) {
            fd.append('idbanner', idbanner);
            fd.append('title', title);
            fd.append('description', description);
            fd.append('link', link);
            fd.append('position', position);
            fd.append('cover', cover);

            $.each($('#form-publish').serializeArray(), function(a, b) {
			   	fd.append(b.name, b.value);
			});

            $.ajax({
                url: '{{ url("/admin/banner/put") }}',
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

    function deleteImages (idowner, idimages) 
    { 
        var a = confirm('Delete this images?');
        if (a == true) {
            $.ajax({
                url: '{{ url("/admin/images/remove") }}',
                dataType: 'json',
                type: 'post',
                data: {
                    'idimages': idimages
                },
				beforeSend: function() {
					loadPopup('show');
				}
			})
			.done(function(data) {
			   	if (data.status == 'success') 
                {
                    window.location = server+'/admin/product/edit/'+idowner;
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
        }
    }

    $(document).ready(function() {
        $("#description").on('keyup', function() {
            $('#display_count').text(this.value.length);
        });
    });
</script>

<div class="padding-top-20px"></div>

<h1 class="ctn-font ctn-small ctn-font-primary-bold ctn-min-color">Edit Produk</h1>

<form 
    id="form-publish" 
    method="post" 
    action="javascript:void(0)" 
    enctype="multipart/form-data" 
    onsubmit="publish()">
    @foreach ($banner as $bn)
        <div class="content-create">
            <div class="cc-left">

                <input type="hidden" id="idbanner" value="{{ $bn->idbanner }}">

                <div class="cc-block">
                    <div class="label">
                        Cover
                    </div>
                    <div class="grid">
                        <div class="col-1 padding-bottom-10px">
                            <div
                                id="add-pict" 
                                class="image image-150px"
                                style="background-image: url('{{ asset('img/banner/thumbnails/'.$bn->cover) }}');"
                            ></div>
                        </div>
                        <div class="col-1 padding-top-20px">
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
                        required="required"
                        class="txt txt-primary-color"
                        value="{{ $bn->title }}"
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
                        maxlength="250">{{ $bn->description }}</textarea>
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
    @endforeach
</form>

<div class="padding-top-20px"></div>

<div class="content-page">
    <div class="cp-top">
        <div class="cp-left">
            <h1 class="ctn-font ctn-small ctn-font-primary-bold ctn-min-color">Detail</h1>
        </div>
        <div class="cp-right">
            <a href="{{ url('/admin/images/create/'.$idbanner.'/product') }}">
                <button class="btn btn-main-color btn-radius">
                    <span class="icn icn-left fa fa-lg fa-plus"></span>
                    <span>Buat Detail</span>
                </button>
            </a>
            <form action="#">
                <div class="search">
                    <input 
                        type="text" 
                        class="src txt txt-main-color" 
                        placeholder="Search..." 
                        required="required">
                    <button class="bt btn btn-main-color" type="submit">
                        <span class="fa fa-lg fa-search"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="cp-mid">
        <table>
            <thead>
                <tr>
                    <th width="20">No</th>
                    <th width="100" class="mobile">Cover</th>
                    <th width="100">Judul</th>
                    <th width="100" class="mobile">Owner</th>
                    <th width="100" class="mobile">Tanggal</th>
                    <th width="100"></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($images as $dt)
                <tr>
                    <td>
                        <strong>{{ $i }}</strong>
                    </td>
                    <td class="mobile">
                        <div 
                            class="image image-100px" 
                            style="
                                background-image: url({{ asset('/img/images/thumbnails/'.$dt->cover) }});
                            "></div>
                    </td>
                    <td>{{ $dt->description }}</td>
                    <td class="mobile">{{ $dt->idowner }}</td>
                    <td class="mobile">{{ $dt->date }}</td>
                    <td>
                        <a href="{{ url('/admin/images/edit/'.$dt->idowner.'/'.$dt->idimages) }}">
                            <button class="btn btn-sekunder-color btn-circle">
                                <span class="fa fa-1x fa-pencil-alt"></span>
                            </button>
                        </a>
                        <button 
                            class="btn btn-sekunder-color btn-circle"
                            onclick="deleteImages('{{ $dt->idowner }}', '{{ $dt->idimages }}')">
                            <span class="fa fa-1x fa-trash-alt"></span>
                        </button>
                    </td>
                </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection