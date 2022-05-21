@extends('layouts.admin')
@section('content')

<script>
    var server = '{{ url("/") }}';

    function draftArticle(idarticle) 
    {  
        var path = $('#btn-article-draft-'+idarticle);
        var tr = path.attr('data');
        $.ajax({
            url: '{{ url("/admin/article/changeDraft") }}',
            dataType: 'json',
            type: 'post',
            data: {
                'idarticle': idarticle
            },
			beforeSend: function() {
				loadPopup('show');
			}
		})
		.done(function(data) {
            if (data.status == 'success') 
            {
                loadPopup('hide');
                if (data.draft == '1') 
                {
                    path
                    .attr({
                        'class': 'toggle toggle-primary fa fa-lg fa-toggle-on'
                    });
                } 
                else 
                {
                    path
                    .attr({
                        'class': 'toggle toggle-grey fa fa-lg fa-toggle-off'
                    });
                }
            }
            if (data.status == 'error') 
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

    function pinnedArticle(idarticle) 
    {  
        var path = $('#btn-article-pin-'+idarticle);
        $.ajax({
            url: '{{ url("/admin/article/changePinned") }}',
            dataType: 'json',
            type: 'post',
            data: {
                'idarticle': idarticle
            },
			beforeSend: function() {
				loadPopup('show');
			}
		})
		.done(function(data) {
            loadPopup('hide');
            if (data.status == 'success') 
            {
                if (data.pinned == '1') 
                {
                    path
                    .attr({
                        'class': 'toggle toggle-primary fa fa-lg fa-toggle-on'
                    });
                } 
                else 
                {
                    path
                    .attr({
                        'class': 'toggle toggle-grey fa fa-lg fa-toggle-off'
                    });
                }
            }
            if (data.status == 'error') 
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
    
    function deleteArticle (idarticle) 
    { 
        var a = confirm('Delete this article?');
        if (a == true) {
            $.ajax({
                url: '{{ url("/admin/article/remove") }}',
                dataType: 'json',
                type: 'post',
                data: {
                    'idarticle': idarticle
                },
				beforeSend: function() {
					loadPopup('show');
				}
			})
			.done(function(data) {
			   	if (data.status == 'success') 
                {
                    window.location = server+'/admin/article';
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
            <h1 class="ctn-font ctn-small ctn-font-primary-bold ctn-min-color">Artikel & Blog</h1>
        </div>
        <div class="cp-right">
            <a href="{{ url('/admin/article/create') }}">
                <button class="btn btn-main-color btn-radius">
                    <span class="icn icn-left fa fa-lg fa-plus"></span>
                    <span>Buat Artikel</span>
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
                    <th>Judul</th>
                    <th width="150" class="mobile">Tanggal</th>
                    <th width="60" class="mobile">Tipe</th>
                    <th width="60" class="mobile">Draft</th>
                    <th width="60" class="mobile">Pinned</th>
                    <th width="100"></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($article as $at)
                <tr>
                    <td>
                        <strong>{{ $i }}</strong>
                    </td>
                    <td class="mobile">
                        <div 
                            class="image image-100px" 
                            style="
                                background-image: url({{ asset('/img/article/thumbnails/'.$at->cover) }});
                            "></div>
                    </td>
                    <td>{{ $at->title }}</td>
                    <td class="mobile">{{ $at->date }}</td>
                    <td class="mobile">
                        <div style="margin: auto; text-transform: capitalize;">
                            <strong>{{ $at->type }}</strong>
                        </div>
                    </td>
                    <td class="mobile">
                        @if ($at->is_draft == '1')
                            <button 
                                id="btn-article-draft-{{ $at->idarticle }}"
                                onclick="draftArticle('{{ $at->idarticle }}')" 
                                class="toggle toggle-danger fa fa-lg fa-toggle-on"></button>
                            <!--    
                            <div style="margin: auto; text-transform: capitalize;">
                                <strong>Draft</strong>
                            </div>
                            <button
                                id="btn-article-draft-{{ $at->idarticle }}" 
                                class="btn-type btn-color-5 wd-small"
                                onclick="draftArticle('{{ $at->idarticle }}')" 
                                style="margin: auto; cursor: pointer;">
                                Draft
                            </button>
                            -->
                        @else
                            <button 
                                id="btn-article-draft-{{ $at->idarticle }}"
                                onclick="draftArticle('{{ $at->idarticle }}')" 
                                class="toggle toggle-grey fa fa-lg fa-toggle-off"></button>
                            <!--
                            <div style="margin: auto; text-transform: capitalize;">
                                <strong>Publish</strong>
                            </div>
                            <button 
                                id="btn-article-draft-{{ $at->idarticle }}" 
                                class="btn-type btn-color-30 wd-small" 
                                onclick="draftArticle('{{ $at->idarticle }}')" 
                                style="margin: auto; cursor: pointer;">
                                Publish
                            </button>
                            -->
                        @endif
                    </td>
                    <td class="mobile">
                        @if ($at->is_pinned == '1')
                            <button 
                                id="btn-article-pin-{{ $at->idarticle }}"
                                onclick="pinnedArticle('{{ $at->idarticle }}')" 
                                class="toggle toggle-primary fa fa-lg fa-toggle-on"></button>
                        @else 
                            <button 
                                id="btn-article-pin-{{ $at->idarticle }}"
                                onclick="pinnedArticle('{{ $at->idarticle }}')" 
                                class="toggle toggle-grey fa fa-lg fa-toggle-off"></button>
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('/admin/article/edit/'.$at->idarticle) }}">
                            <button class="btn btn-sekunder-color btn-circle">
                                <span class="fa fa-1x fa-pencil-alt"></span>
                            </button>
                        </a>
                        <button 
                            class="btn btn-sekunder-color btn-circle"
                            onclick="deleteArticle('{{ $at->idarticle }}')">
                            <span class="fa fa-1x fa-trash-alt"></span>
                        </button>
                    </td>
                </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $article->links() }}
        </div>
    </div>
</div>
@endsection