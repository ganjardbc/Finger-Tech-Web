@extends('layouts.admin')
@section('content')
<script>
    var server = '{{ url("/") }}';
    
    function deleteTestimony ($idtestimony) 
    { 
        var a = confirm('Delete this testimony?');
        if (a == true) {
            $.ajax({
                url: '{{ url("/admin/testimony/remove") }}',
                dataType: 'json',
                type: 'post',
                data: {
                    'idtestimony': $idtestimony
                },
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
        }
    }
</script>

<div class="padding-top-20px"></div>

<div class="content-page">
    <div class="cp-top">
        <div class="cp-left">
            <h1 class="ctn-font ctn-small ctn-font-primary-bold ctn-min-color">Testimony</h1>
        </div>
        <div class="cp-right">
            <a href="{{ url('/admin/testimony/create') }}">
                <button class="btn btn-main-color btn-radius">
                    <span class="icn icn-left fa fa-lg fa-plus"></span>
                    <span>Buat Testimony</span>
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
                    <th width="100" class="mobile">Foto</th>
                    <th>Nama</th>
                    <th width="100" class="mobile">Pekerjaan</th>
                    <th width="150" class="mobile">Tanggal</th>
                    <th width="100"></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($testimony as $tt)
                <tr>
                    <td><strong>{{ $i }}</strong></td>
                    <td class="mobile">
                        <div 
                            class="image image-50px image-circle" 
                            style="
                                background-image: url({{ asset('/img/testimony/thumbnails/'.$tt->photo) }});
                            "></div>
                    </td>
                    <td>{{ $tt->name }}</td>
                    <td class="mobile">{{ $tt->job }}</td>
                    <td class="mobile">{{ $tt->date }}</td>
                    <td>
                        <a href="{{ url('/admin/testimony/edit/'.$tt->idtestimony) }}">
                            <button class="btn btn-sekunder-color btn-circle">
                                <span class="fa fa-1x fa-pencil-alt"></span>
                            </button>
                        </a>
                        <button 
                            class="btn btn-sekunder-color btn-circle"
                            onclick="deleteTestimony('{{ $tt->idtestimony }}')">
                            <span class="fa fa-1x fa-trash-alt"></span>
                        </button>
                    </td>
                </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $testimony->links() }}
        </div>
    </div>
</div>
@endsection