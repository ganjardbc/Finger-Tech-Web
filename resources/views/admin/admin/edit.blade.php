@extends('layouts.admin')
@section('content')

<script>
    var server = "{{ url('/') }}";

    function deleteAdmin (idadmin) 
    { 
        var a = confirm('Delete your admin account?');
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

    function editFotoProfile() {
		var fd = new FormData();

        var ctn = $('#cover')[0].files.length;
        var photo = $('#cover')[0].files[0];

        if (ctn > 0) {
            fd.append('photo', photo);

            $.each($('#form-photo').serializeArray(), function(a, b) {
			   	fd.append(b.name, b.value);
			});

            $.ajax({
                url: '{{ url("/admin/admin/photo") }}',
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
                    window.location = server+'/admin/admin/edit';
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

    function editInformation() {  
		var fd = new FormData();
        
        var name = $('#name').val();
		var email = $('#email').val();
        var username = $('#username').val();
		var ctn = 1;

        if (ctn > 0) {
            fd.append('name', name);
            fd.append('email', email);
            fd.append('username', username);

            $.each($('#form-informasi').serializeArray(), function(a, b) {
			   	fd.append(b.name, b.value);
			});

            $.ajax({
                url: '{{ url("/admin/admin/put") }}',
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
			})
			.always(function () {
				//after done
			});
        } else {
            alert('Please select one cover');
        }

		return false;
    }

    function editPassword() {  
		var fd = new FormData();
        
        var oldPassword = $('#oldPassword').val();
		var newPassword = $('#newPassword').val();
        var confirmPassword = $('#confirmPassword').val();
		var ctn = 1;

        if (ctn > 0) {
            fd.append('oldPassword', oldPassword);
            fd.append('newPassword', newPassword);
            fd.append('confirmPassword', confirmPassword);

            $.each($('#form-password').serializeArray(), function(a, b) {
			   	fd.append(b.name, b.value);
			});

            $.ajax({
                url: '{{ url("/admin/admin/password") }}',
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
			})
			.always(function () {
				//after done
			});
        } else {
            alert('Please select one cover');
        }

		return false;
    }
</script>

<div class="padding-top-20px"></div>

<div class="content-page">
    <h1 class="ctn-font ctn-small ctn-font-primary-bold ctn-min-color">Akun Admin</h1>

    <form 
        id="form-photo" 
        method="post" 
        action="javascript:void(0)" 
        enctype="multipart/form-data" 
        onsubmit="editFotoProfile()">
        <div class="content-create">
            <div class="cc-left">
                <div class="cc-block">
                    <h1 class="ctn-font ctn-16pt ctn-font-primary-bold ctn-min-color">Ganti Foto Profil</h1>
                </div>
                @foreach ($user as $us)
                    <div class="cc-block">
                        <div>
                            <div class="">
                                <div class="padding-bottom-20px">
                                    <div
                                        id="add-pict" 
                                        class="image image-150px image-circle"
                                        style="
                                            background-image: url({{ asset('/img/admin/thumbnails/'.$us->photo) }});
                                        "></div>
                                </div>
                                <div class="padding-top-20px">
                                    <div class="position middle">
                                        <input type="file" name="cover" id="cover" required="required">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="cc-right">
                <div class="cc-block bdr-all">
                    <div class="label">
                        Catatan
                    </div>
                    <ul class="cc-note">
                        <li></li>
                    </ul>
                </div>
                <div class="cc-block">
                    <input 
                        type="submit" 
                        value="Simpan Foto Profil"
                        class="btn btn-main-color">
                </div>
            </div>
        </div>
    </form>

    <form 
        id="form-informasi" 
        method="post" 
        action="javascript:void(0)" 
        onsubmit="editInformation()">
        <div class="content-create">
            <div class="cc-left">
                <div class="cc-block">
                    <h1 class="ctn-font ctn-16pt ctn-font-primary-bold ctn-min-color">Ganti Informasi Akun</h1>
                </div>
                @foreach ($user as $us)
                    <div class="cc-block">
                        <div class="label">
                            Nama
                        </div>
                        <input 
                            type="text"
                            name="name"
                            id="name"
                            class="txt txt-primary-color"
                            value="{{ $us->name }}"
                            placeholder="">
                    </div>

                    <div class="cc-block">
                        <div class="label">
                            Email
                        </div>
                        <input 
                            type="email"
                            name="email"
                            id="email"
                            class="txt txt-primary-color"
                            value="{{ $us->email }}"
                            placeholder="">
                    </div>
                    <div class="cc-block">
                        <div class="label">
                            Username
                        </div>
                        <input 
                            type="text"
                            name="username"
                            id="username"
                            class="txt txt-primary-color"
                            value="{{ $us->username }}"
                            placeholder="">
                    </div>
                @endforeach
            </div>
            <div class="cc-right">
                <div class="cc-block bdr-all">
                    <div class="label">
                        Catatan
                    </div>
                    <ul class="cc-note">
                        <li>Isi semua field dengan data yang benar dan sesungguhnya</li>
                    </ul>
                </div>
                <div class="cc-block">
                    <input 
                        type="submit" 
                        value="Simpan Informasi"
                        class="btn btn-main-color">
                </div>
            </div>
        </div>
    </form>

    <form 
        id="form-password" 
        method="post" 
        action="javascript:void(0)" 
        onsubmit="editPassword()">
        <div class="content-create">
            <div class="cc-left">
                <div class="cc-block">
                    <h1 class="ctn-font ctn-16pt ctn-font-primary-bold ctn-min-color">Ganti Password</h1>
                </div>
                @foreach ($user as $us)
                    <div class="cc-block">
                        <div class="label">
                            Password Lama
                        </div>
                        <input 
                            type="password"
                            name="oldPassword"
                            id="oldPassword"
                            class="txt txt-primary-color"
                            required="required"
                            placeholder="">
                    </div>

                    <div class="padding-10px"></div>

                    <div class="cc-block">
                        <div class="label">
                            Password Baru
                        </div>
                        <input 
                            type="password"
                            name="newPassword"
                            id="newPassword"
                            class="txt txt-primary-color"
                            required="required"
                            placeholder="">
                    </div>
                    <div class="cc-block">
                        <div class="label">
                            Konfirmasi Password
                        </div>
                        <input 
                            type="password"
                            name="confirmPassword"
                            id="confirmPassword"
                            class="txt txt-primary-color"
                            required="required"
                            placeholder="">
                    </div>
                @endforeach
            </div>
            <div class="cc-right">
                <div class="cc-block bdr-all">
                    <div class="label">
                        Catatan
                    </div>
                    <ul class="cc-note">
                        <li>Hati-hati dengan penggunaan password</li>
                        <li>Buatlah password yang mungkin sulit untuk ditebak oleh orang lain</li>
                        <li>Ingatlah password baru yang sudah dibuat</li>
                    </ul>
                </div>
                <div class="cc-block">
                    <input 
                        type="submit" 
                        value="Simpan Password"
                        class="btn btn-main-color">
                </div>
            </div>
        </div>
    </form>

    <div class="content-create">
        <div class="cc-left">
            <div class="cc-block">
                <h1 class="ctn-font ctn-16pt ctn-font-primary-bold ctn-min-color">Hapus Akun</h1>
            </div>
            <div class="cc-block">
                <div class="label">
                    Menghapus Permanen
                </div>
                <div class="desc">
                    <p>
                        Opsi ini akan menghapus akun admin anda secara
                        permanen, ketika anda mengklik tombol hapus 
                        maka anda tidak bisa mengembalikan akun anda seperti semula.
                    </p>
                </div>
                <div style="margin-top: 15px;">
                    <input 
                        type="button" 
                        value="Hapus Akun"
                        class="btn btn-danger-color"
                        onclick="deleteAdmin('{{ Auth::id() }}')">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection