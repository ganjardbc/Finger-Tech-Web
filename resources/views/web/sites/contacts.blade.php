@extends('layouts.web')
@section('title', $title)
@section('content')

<script>
    var server = '{{ url("/") }}';

    function publish() {
        var service = $('#service').val();
        var name = $('#name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var budget = $('#budget').val();
        var message = $('#message').val();
        var status = $('#status').is(':checked');
        var a = confirm('Submit your message ?');

        if (a) {
            var fd = new FormData();

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

            console.log('form', fd)

            $.ajax({
                url: '{{ url("/contact/publish") }}',
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
                    alert('Your data has been submited, we will reach you as soon as posible !');
                    window.location = server+'/contacts';
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

		return false;
	}

    $(document).ready(function() {
        $("#message").on('keyup', function() {
            $('#display_count').text(this.value.length);
        });
    });
</script>

<div class="body-block">
	<div class="banner-container">
        <div class="main-container display-flex space-between align-center display-mobile">
            <div class="width width-50 width-mobile">
                <div class="width width-100 width-mobile">
                    <div>
                        <p class="ctn-font ctn-14pt ctn-white-color ctn-line ctn-font-sekunder-thin">
                            {{ config('app.name') }}
                        </p>
                        <h2 class="ctn-font ctn-32pt ctn-white-color ctn-font-primary-semibold ctn-small-line" style="margin: 15px 0;">
                            CONTACTS
                        </h2>
                        <p class="ctn-font ctn-14pt ctn-white-color ctn-line ctn-font-sekunder-thin">
                            Do not hesitate to ask. We would be pleasure to assist your needs.
                        </p>
                    </div>
                </div>
            </div>
            <div class="width width-50 width-mobile"></div>
        </div>
    </div>

    <div class="main-container display-flex space-between">
        <div class="width width-45">
            <h2 
                class="ctn-font ctn-micro ctn-min-color ctn-font-primary-semibold" 
                style="margin-bottom: 30px;">
                {{ config('app.name') }}
            </h2>
            <p 
                class="ctn-font ctn-14pt ctn-min-color ctn-line ctn-font-sekunder-semibold"
                style="margin-bottom: 30px;">
                We will contact you to arrange your initial consultation free of charge, without obligation.
            </p>
            <p 
                class="ctn-font ctn-14pt ctn-min-color ctn-line ctn-font-sekunder-thin"
                style="margin-bottom: 30px;">
                Do not hesitate to consult your needs for free with our team. we will help you understand the solution in detail and how it works. Increase your business by becoming our partner now.
            </p>
        </div>
        <div class="width width-45">
            <div 
                class="image image-all" 
                style="background-image: url({{ asset('img/sites/Peta-Indonesia.webp') }}); padding-bottom: 40%;"></div>
        </div>
    </div>

    <div class="main-container">
        <div class="banner-container border-radius">
            <div class="width width-80 width-center width-mobile" style="padding-bottom: 20px;">
                <div style="padding: 0 15px;">
                    <h1 
                        class="ctn-font ctn-24pt ctn-white-color ctn-font-primary-semibold ctn-center"
                        style="margin-bottom: 15px;">
                        Contact
                    </h1>
                    <p class="ctn-font ctn-14pt ctn-white-color ctn-line ctn-center ctn-font-sekunder-thin">
                        Fill in the simple form below. Our team will contact you shortly to discuss next steps.
                    </p>
                </div>
            </div>
            <form 
                id="form-publish" 
                method="post" 
                action="javascript:void(0)" 
                enctype="multipart/form-data" 
                onsubmit="publish()">
                <div class="padding-all-20px">
                    <h2 
                        class="ctn-font ctn-micro ctn-white-color ctn-font-primary-semibold" 
                        style="margin-bottom: 0px;">
                        Informations
                    </h2>
                    <div class="display-flex display-flex space-between">
                        <div class="width width-48">
                            <div class="content-create no-grid">
                                <div class="cc-block">
                                    <div class="ctn-font ctn-11pt ctn-white-color" style="color: #fff; margin-bottom: 10px;">
                                        Pilih Project
                                    </div>
                                    <select 
                                        class="slc" 
                                        style="width: 100%;" 
                                        name="service" 
                                        id="service"
                                        required="required">
                                        <option value="">-- Pilih Project --</option>
                                        @foreach($service as $dt)
                                            <option value="{{ $dt->title }}">{{ $dt->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="cc-block">
                                    <div class="ctn-font ctn-11pt ctn-white-color" style="color: #fff; margin-bottom: 10px;">
                                        Name
                                    </div>
                                    <input 
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="txt txt-primary-color"
                                        required="required"
                                        placeholder="">
                                </div>
                                <div class="cc-block">
                                    <div class="ctn-font ctn-11pt ctn-white-color" style="color: #fff; margin-bottom: 10px;">
                                        Email
                                    </div>
                                    <input 
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="txt txt-primary-color"
                                        required="required"
                                        placeholder="">
                                </div>
                                <div class="cc-block">
                                    <div class="ctn-font ctn-11pt ctn-white-color" style="color: #fff; margin-bottom: 10px;">
                                        Phone
                                    </div>
                                    <input 
                                        type="number"
                                        name="phone"
                                        id="phone"
                                        class="txt txt-primary-color"
                                        required="required"
                                        placeholder="">
                                </div>
                                <div class="cc-block">
                                    <div class="ctn-font ctn-11pt ctn-white-color" style="color: #fff; margin-bottom: 10px;">
                                        Budget (Rp.)
                                    </div>
                                    <input 
                                        type="number"
                                        name="budget"
                                        id="budget"
                                        class="txt txt-primary-color"
                                        required="required"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="width width-48">
                            <div class="content-create no-grid">
                                <div class="cc-block">
                                    <div class="ctn-font ctn-11pt ctn-white-color display-flex space-between align-center" style="color: #fff; margin-bottom: 10px;">
                                        Message
                                        <span>
                                            <span id="display_count">0</span>/1000
                                        </span>
                                    </div>
                                    <textarea 
                                        name="message" 
                                        id="message"
                                        class="txt txt-primary-color edit-text"
                                        style="min-height: 370px; max-height: 370px;"
                                        maxlength="1000"
                                        required="required"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="padding-all-20px">
                    <p class="ctn-font ctn-12pt ctn-white-color ctn-line ctn-font-sekunder-thin">
                        Clients are priority for us. We will process the above information to contact you and discuss your needs. We would like to contact you about our other products and services, as well as other information that may be of interest to you. If you agree to contact you for this purpose, please tick below .
                    </p>
                    <div class="content-create no-grid">
                        <div class="cc-block" style="padding-bottom: 0;">
                            <div class="rd">
                                <input type="checkbox" name="status" id="status" style="margin-right: 5px;" required="required">
                                <label for="status" style="color: #fff;">I agree to receive marketing communication from Finger Tech</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="padding-all-20px">
                    <div class="width width-20 width-mobile">
                        <button type="submit" class="btn btn-main-color btn-full">
                            SUBMIT <i class="icn icn-right fa fa-lg fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection