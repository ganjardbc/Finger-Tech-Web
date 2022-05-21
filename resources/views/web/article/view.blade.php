@extends('layouts.web')
@section('title', $title)
@section('content')

<div class="body-block">
    <div class="banner-container">
        <div class="main-container" style="height: 50px;"></div>
    </div>

    <div style="position: relative; top: -120px; width: 100%;">
        <div class="main-container-medium border-all bg-white" style="border-radius: 12px;">
            <div class="display-flexs space-between" style="padding: 60px; padding-bottom: 0;">
                <div class="width width-85 width-center">
                    <div 
                        class="image image-full image-radius"
                        style="background-image: url({{ asset('/img/article/covers/'.$article->cover) }}); margin-bottom: 60px;">
                    </div>
                </div>
                <div class="width width-85 width-center">
                    <div class="frm-story">
                        <div class="mid" style="padding-top: 0;">
                            <div class="title">
                                <h1 class="ctn-font ctn-32pt ctn-min-color ctn-font-primary-semibold">{{ $article->title }}</h1>
                            </div>
                            <div class="date" style="padding-top: 32px; padding-bottom: 32px;">
                                <span class="icn fa fa-lg fa-clock"></span>
                                <span>{{ date_format(date_create($article->date), "M d, Y") }}</span>
                                <span class="icn fa fa-lg fa-user" style="margin-left: 10px;"></span>
                                <span>{{ $article->name }}</span>
                            </div>
                            <div class="desc">
                                <?php echo $article->content; ?>
                            </div>
                        </div>

                        <!-- <div class="bot padding-20px">
                            <div id="disqus_thread"></div>
                            <script>

                            (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document, s = d.createElement('script');
                            s.src = 'https://kebunbegonia.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                            })();
                            </script>
                            <noscript>
                                Please enable JavaScript to view the 
                                <a href="https://disqus.com/?ref_noscript">
                                    comments powered by Disqus.
                                </a>
                            </noscript>
                        </div> -->

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection