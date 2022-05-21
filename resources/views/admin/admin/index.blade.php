@extends('layouts.admin')
@section('content')

<script type="text/javascript">
    function deleteAdmin (idadmin) 
    { 
        var a = confirm('Delete this admin?');
        if (a == true) {
            $.ajax({
                url: '{{ url("/admin/admin/remove") }}',
                dataType: 'json',
                type: 'post',
                data: {
                    'idadmin': idadmin
                },
                beforeSend: function() {
                    loadPopup('show');
                }
            })
            .done(function(data) {
                if (data.status == 'success') 
                {
                    window.location = server+'/admin/admin';
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
            <h1 class="ctn-font ctn-22pt ctn-font-primary-bold ctn-min-color">Pengelolaan Admin</h1>
        </div>
        <div class="cp-right">
            <a href="{{ url('/admin/admin/create') }}">
                <button class="btn btn-main-color btn-radius">
                    <span class="icn icn-left fa fa-lg fa-plus"></span>
                    <span>Buat Akun Admin</span>
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
                    <th width="120" class="mobile">Foto</th>
                    <th width="200">Nama</th>
                    <th class="mobile">Email</th>
                    <th width="150" class="mobile">Username</th>
                    <th width="150" class="mobile">Tanggal</th>
                    <th width="100"></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($user as $us)
                <tr>
                    <td><strong>{{ $i }}</strong></td>
                    <td class="mobile">
                        <div 
                            class="image image-50px image-circle" 
                            style="
                                background-image: url({{ asset('/img/admin/thumbnails/'.$us->photo) }});
                            "></div>
                    </td>
                    <td>{{ $us->name }}</td>
                    <td class="mobile">{{ $us->email }}</td>
                    <td class="mobile">{{ $us->username }}</td>
                    <td class="mobile">{{ $us->created_at }}</td>
                    <td>
                        <button 
                            class="btn btn-sekunder-color btn-circle"
                            onclick="deleteAdmin('{{ $us->id }}')">
                            <span class="fa fa-1x fa-trash-alt"></span>
                        </button>
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
