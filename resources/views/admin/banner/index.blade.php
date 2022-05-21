@extends('layouts.admin')
@section('content')

<script>
    var server = '{{ url("/") }}';

    function positionBanner(idbanner) {
        var position = $('#position').val();
        $.ajax({
            url: '{{ url("/admin/banner/changePosition") }}',
            dataType: 'json',
            type: 'post',
            data: {
                'idbanner': idbanner,
                'position': position
            },
            beforeSend: function() {
                loadPopup('show');
            }
        })
        .done(function(data) {
            loadPopup('hide');
            alert(data.message);
        })
        .fail(function(data) {
            loadPopup('hide');
            alert(data.responseJSON.message);
        })
        .always(function () {
            //after done
        });
    }
    
    function deleteBanner (idbanner) 
    { 
        var a = confirm('Delete this product?');
        if (a == true) {
            $.ajax({
                url: '{{ url("/admin/banner/remove") }}',
                dataType: 'json',
                type: 'post',
                data: {
                    'idbanner': idbanner
                },
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
            <h1 class="ctn-font ctn-small ctn-font-primary-bold ctn-min-color">Produk</h1>
        </div>
        <div class="cp-right">
            <a href="{{ url('/admin/product/create') }}">
                <button class="btn btn-main-color btn-radius">
                    <span class="icn icn-left fa fa-lg fa-plus"></span>
                    <span>Buat Produk</span>
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
                    <th class="mobile">Deskripsi</th>
                    <th width="100" class="mobile">Tanggal</th>
                    <th width="100"></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($banner as $bn)
                <tr>
                    <td><strong>{{ $i }}</strong></td>
                    <td class="mobile">
                        <div 
                            class="image image-100px" 
                            style="
                                background-image: url('{{ asset('img/banner/thumbnails/'.$bn->cover) }}')
                            "></div>
                    </td>
                    <td>{{ $bn->title }}</td>
                    <td class="mobile">{{ $bn->description }}</td>
                    <td class="mobile">{{ $bn->date }}</td>
                    <td>
                        <a href="{{ url('/admin/product/edit/'.$bn->idbanner) }}">
                            <button class="btn btn-sekunder-color btn-circle">
                                <span class="fa fa-1x fa-pencil-alt"></span>
                            </button>
                        </a>
                        <button 
                            class="btn btn-sekunder-color btn-circle"
                            onclick="deleteBanner('{{ $bn->idbanner }}')">
                            <span class="fa fa-1x fa-trash-alt"></span>
                        </button>
                    </td>
                </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $banner->links() }}
        </div>
    </div>
</div>
@endsection