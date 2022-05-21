@extends('layouts.admin')
@section('content')
<?php 
    use Adventrest\TagModel; 
?>
<script>
    var server = '{{ url("/") }}';
    
    function deleteGalery ($idgalery) 
    { 
        var a = confirm('Delete this portofolio?');
        if (a == true) {
            $.ajax({
                url: '{{ url("/admin/galery/remove") }}',
                dataType: 'json',
                type: 'post',
                data: {
                    'idgalery': $idgalery
                },
				beforeSend: function() {
					loadPopup('show');
				}
			})
			.done(function(data) {
			   	if (data.status == 'success') 
                {
                    window.location = server+'/admin/portofolio';
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
        }
    }
</script>

<div class="padding-top-20px"></div>

<div class="content-page">
    <div class="cp-top">
        <div class="cp-left">
            <h1 class="ctn-font ctn-small ctn-font-primary-bold ctn-min-color">Portofolio</h1>
        </div>
        <div class="cp-right">
            <a href="{{ url('/admin/portofolio/create') }}">
                <button class="btn btn-main-color btn-radius">
                    <span class="icn icn-left fa fa-lg fa-plus"></span>
                    <span>Buat Portofolio</span>
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
                    <th width="100">Cover</th>
                    <th class="mobile">Judul</th>
                    <th class="mobile" class="mobile">Deskripsi</th>
                    <th width="150" class="mobile">Tanggal</th>
                    <th width="100"></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($galery as $gl)
                <tr>
                    <td><strong>{{ $i }}</strong></td>
                    <td>
                        <div 
                            class="image image-100px" 
                            style="
                                background-image: url({{ asset('/img/galery/thumbnails/'.$gl->cover) }});
                            "></div>
                    </td>
                    <td class="mobile">{{ $gl->title }}</td>
                    <td class="mobile">{{ $gl->description }}</td>
                    <td class="mobile">{{ $gl->date }}</td>
                    <td>
                        <a href="{{ url('/admin/portofolio/edit/'.$gl->idgalery) }}">
                            <button class="btn btn-sekunder-color btn-circle">
                                <span class="fa fa-1x fa-pencil-alt"></span>
                            </button>
                        </a>
                        <button 
                            class="btn btn-sekunder-color btn-circle"
                            onclick="deleteGalery('{{ $gl->idgalery }}')">
                            <span class="fa fa-1x fa-trash-alt"></span>
                        </button>
                    </td>
                </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $galery->links() }}
        </div>
    </div>
</div>
@endsection