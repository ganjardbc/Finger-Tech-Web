@extends('layouts.admin')
@section('content')
<script>
    var server = '{{ url("/") }}';

    function publish() {
		var fd = new FormData();
        var idcontact = $('#idcontact').val();
        var service = $('#service').val();
        var name = $('#name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var budget = $('#budget').val();
        var message = $('#message').val();
        var status = $('#status').is(':checked');

        if (status) {
            fd.append('idcontact', idcontact);
            fd.append('service', service);
            fd.append('name', name);
            fd.append('email', email);
            fd.append('phone', phone);
            fd.append('budget', budget);
            fd.append('message', message);
            fd.append('status', status);

            $.each($('#form-publish').serializeArray(), function(a, b) {
			   	fd.append(b.name, b.value);
			});

            $.ajax({
                url: '{{ url("/admin/contact/put") }}',
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
                    window.location = server+'/admin/contact';
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
            alert('Please select one foto');
        }

		return false;
	}

    $(document).ready(function() {
        $("#message").on('keyup', function() {
            $('#display_count').text(this.value.length);
        });
    });
</script>

<div class="padding-top-20px"></div>

<h1 class="ctn-font ctn-small ctn-font-primary-bold ctn-min-color">Edit Kontak</h1>

<form 
    id="form-publish" 
    method="post" 
    action="javascript:void(0)" 
    enctype="multipart/form-data" 
    onsubmit="publish()">
    <div class="content-create">
        <div class="cc-left">
            <input type="hidden" id="idcontact" value="{{ $contact->idcontact }}">

            <div class="cc-block">
                <div class="label">
                    Pilih Project
                </div>
                <select 
                    class="slc border-all" 
                    style="width: 100%;" 
                    name="service" 
                    id="service"
                    required="required">
                    <option value="">-- Pilih Project --</option>
                    @foreach($service as $dt)
                        @if($dt->title == $contact->service)
                            <option value="{{ $dt->title }}" selected>{{ $dt->title }}</option>
                        @else
                            <option value="{{ $dt->title }}">{{ $dt->title }}</option>
                        @endif 
                    @endforeach
                </select>
            </div>
        
            <div class="cc-block">
                <div class="label">
                    Nama
                </div>
                <input 
                    type="text"
                    name="name"
                    class="txt txt-primary-color"
                    id="name"
                    required="required"
                    value="{{ $contact->name }}"
                    placeholder="">
            </div>

            <div class="cc-block">
                <div class="label">
                    Email
                </div>
                <input 
                    type="email"
                    name="email"
                    class="txt txt-primary-color"
                    id="email"
                    required="required"
                    value="{{ $contact->email }}"
                    placeholder="">
            </div>

            <div class="cc-block">
                <div class="label">
                    No. Telpon
                </div>
                <input 
                    type="number"
                    name="phone"
                    class="txt txt-primary-color"
                    id="phone"
                    required="required"
                    value="{{ $contact->phone }}"
                    placeholder="">
            </div>

            <div class="cc-block">
                <div class="label">
                    Budget (Rp.)
                </div>
                <input 
                    type="number"
                    name="budget"
                    class="txt txt-primary-color"
                    id="budget"
                    required="required"
                    value="{{ $contact->budget }}"
                    placeholder="">
            </div>

            <div class="cc-block">
                <div class="label">
                    Message
                </div>
                <div class="padding-bottom-5px">
                    <p class="ctn-font ctn-14px ctn-sek-color">
                        <span id="display_count">0</span>/1000
                    </p>
                </div>
                <textarea 
                    name="message" 
                    id="message"
                    class="txt txt-primary-color edit-text"
                    required="required"
                    maxlength="1000">{{ $contact->message }}</textarea>
            </div>

        </div>
        <div class="cc-right">
            <div class="cc-block bdr-all">
                <div class="label">
                    Catatan
                </div>
                <div class="rd">
                    @if($contact->status)
                        <input 
                            type="checkbox" 
                            name="status" 
                            id="status"
                            value="{{ $contact->status }}" 
                            style="margin-right: 5px;" 
                            required="required"
                            checked>
                    @else
                        <input 
                            type="checkbox" 
                            name="status" 
                            id="status"
                            value="{{ $contact->status }}" 
                            style="margin-right: 5px;" 
                            required="required">
                    @endif 
                    <label for="status">I agree to receive marketing communication from Finger Tech</label>
                </div>
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