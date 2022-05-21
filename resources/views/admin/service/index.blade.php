@extends('layouts.admin')
@section('content')
<script>
    var server = '{{ url("/") }}';
    
    function deleteService ($idservice) 
    { 
        var a = confirm('Delete this service?');
        if (a == true) {
            $.ajax({
                url: '{{ url("/admin/service/remove") }}',
                dataType: 'json',
                type: 'post',
                data: {
                    'idservice': $idservice
                },
				beforeSend: function() {
					loadPopup('show');
				}
			})
			.done(function(data) {
			   	if (data.status == 'success') 
                {
                    window.location = server+'/admin/service';
                } 
                else 
                {
                    loadPopup('hide');
                    alert('data.message');
                }
			})
			.fail(function(data) {
                loadPopup('hide');
			   	console.log(data.responseJSON.message);
			})
			.always(function () {
				//after done
			});
        }
    }
</script>

<div class="padding-top-20px"></div>

<div class="content-page">
    <div class="cp-top">
        <div class="cp-left">
            <h1 class="ctn-font ctn-small ctn-font-primary-bold ctn-min-color">Konten & Layanan</h1>
        </div>
        <div class="cp-right">
            <a href="{{ url('/admin/service/create') }}">
                <button class="btn btn-main-color btn-radius">
                    <span class="icn icn-left fa fa-lg fa-plus"></span>
                    <span>Buat Konten & Layanan</span>
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
                    <th width="150">Judul</th>
                    <th class="mobile" class="mobile">Deskripsi</th>
                    <th width="100" class="mobile">Tanggal</th>
                    <th width="100"></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($service as $sv)
                <tr>
                    <td><strong>{{ $i }}</strong></td>
                    <td class="mobile">
                        <div 
                            class="image image-100px" 
                            style="
                                background-image: url({{ asset('/img/service/thumbnails/'.$sv->cover) }});
                            "></div>
                    </td>
                    <td>{{ $sv->title }}</td>
                    <td class="mobile">{{ $sv->description }}</td>
                    <td class="mobile">{{ $sv->date }}</td>
                    <td>
                        <a href="{{ url('/admin/service/edit/'.$sv->idservice) }}">
                            <button class="btn btn-sekunder-color btn-circle">
                                <span class="fa fa-1x fa-pencil-alt"></span>
                            </button>
                        </a>
                        <button 
                            class="btn btn-sekunder-color btn-circle"
                            onclick="deleteService('{{ $sv->idservice }}')">
                            <span class="fa fa-1x fa-trash-alt"></span>
                        </button>
                    </td>
                </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $service->links() }}
        </div>
    </div>
</div>
@endsection