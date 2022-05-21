@extends('layouts.web')
@section('title', $title)
@section('content')

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
                            ABOUT US
                        </h2>
                        <p class="ctn-font ctn-14pt ctn-white-color ctn-line ctn-font-sekunder-thin">
                            Is a software house and digital marketing company, with profesional, competent young expert and experienced.
                        </p>
                    </div>
                </div>
            </div>
            <div class="width width-50 width-mobile"></div>
        </div>
    </div>

    <div class="padding-only-mobile">

        <div class="main-container display-flex space-between display-mobile">
            <div class="width width-45 width-mobile padding-bottom-only-mobile">
                <h2 
                    class="ctn-font ctn-micro ctn-min-color ctn-font-primary-semibold" 
                    style="margin-bottom: 30px;">
                    Our History
                </h2>
                <p 
                    class="ctn-font ctn-13pt ctn-min-color ctn-line ctn-font-sekunder-thin"
                    style="margin-bottom: 30px;">
                    DIF stand for DIGITAL FACTORY which officially established on February 8, 2016 starting from development of information systems for corporate.
                </p>
                <p 
                    class="ctn-font ctn-13pt ctn-min-color ctn-line ctn-font-sekunder-thin"
                    style="margin-bottom: 30px;">
                    Along with the development of the company, Digital Informasi Futuristik expands the market segment for providing information technology solutions and services digital marketing for Government Institutions, Businesses, Education and UMKM.
                </p>
                <p 
                    class="ctn-font ctn-13pt ctn-min-color ctn-line ctn-font-sekunder-thin"
                    style="margin-bottom: 5px;">
                    And now we have a few products to help your business operational and marketing.
                </p>
            </div>
            <div class="width width-45 width-mobile">
                <div style="margin-bottom: 30px;">
                    <h2 
                        class="ctn-font ctn-micro ctn-min-color ctn-font-primary-semibold" 
                        style="margin-bottom: 15px;">
                        Vision
                    </h2>
                    <p 
                        class="ctn-font ctn-13pt ctn-min-color ctn-line ctn-font-sekunder-thin"
                        style="margin-bottom: 15px;">
                        Be come a trusted and reliable solution partner and information technology developer.
                    </p>
                </div>
                <div style="margin-bottom: 30px;">
                    <h2 
                        class="ctn-font ctn-micro ctn-min-color ctn-font-primary-semibold" 
                        style="margin-bottom: 15px;">
                        Mission
                    </h2>
                    <div style="padding-left: 30px;">
                        <ol class="ctn-font ctn-13pt ctn-min-color ctn-line ctn-font-sekunder-thin">
                            <li>To build and develop quality and useful information technology products.</li>
                            <li>To form an excellent cooperation with our partners.</li>
                            <li>To develop skills and channel resources in the field of information technology.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-container">
            <h2 
                class="ctn-font ctn-micro ctn-min-color ctn-font-primary-semibold" 
                style="margin-bottom: 30px;">
                Company Value
            </h2>
            <div class="display-flex space-between display-mobile">
                <div class="width width-45 width-mobile padding-bottom-only-mobile">
                    <div style="padding-bottom: 30px;">
                        <h2 
                            class="ctn-font ctn-14pt ctn-min-color ctn-font-primary-bold" 
                            style="margin-bottom: 15px;">
                            Respect
                        </h2>
                        <div style="padding-left: 30px;">
                            <ul class="ctn-font ctn-13pt ctn-min-color ctn-line ctn-font-sekunder-thin">
                                <li>Respect, appreciate and be open to differences</li>
                                <li>Give and receive positive and constructive opinions</li>
                            </ul>
                        </div>
                    </div>
                    <div style="padding-bottom: 30px;">
                        <h2 
                            class="ctn-font ctn-14pt ctn-min-color ctn-font-primary-bold" 
                            style="margin-bottom: 15px;">
                            Integrity
                        </h2>
                        <div style="padding-left: 30px;">
                            <ul class="ctn-font ctn-13pt ctn-min-color ctn-line ctn-font-sekunder-thin">
                                <li>Act like owners</li>
                                <li>Learn and be curious</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <h2 
                            class="ctn-font ctn-14pt ctn-min-color ctn-font-primary-bold" 
                            style="margin-bottom: 15px;">
                            Professionalism
                        </h2>
                        <div style="padding-left: 30px;">
                            <ul class="ctn-font ctn-13pt ctn-min-color ctn-line ctn-font-sekunder-thin">
                                <li>Do it, experience it, gain knowledge and make wisdom</li>
                                <li>Be Effective, Efficient and responsible</li>
                                <li>Eliminate ‘IN PROGRESS’ work</li>
                                <li>Do beyond great</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="width width-45 width-mobile">
                    <div style="padding-bottom: 30px;">
                        <h2 
                            class="ctn-font ctn-14pt ctn-min-color ctn-font-primary-bold" 
                            style="margin-bottom: 15px;">
                            Innovation
                        </h2>
                        <div style="padding-left: 30px;">
                            <ul class="ctn-font ctn-13pt ctn-min-color ctn-line ctn-font-sekunder-thin">
                                <li>Ideas over hierarchy</li>
                                <li>Skill improvement and tireless effort produce the best performance</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <h2 
                            class="ctn-font ctn-14pt ctn-min-color ctn-font-primary-bold" 
                            style="margin-bottom: 15px;">
                            Trust
                        </h2>
                        <div style="padding-left: 30px;">
                            <ul class="ctn-font ctn-13pt ctn-min-color ctn-line ctn-font-sekunder-thin">
                                <li>Build synergies to achieve common and company goals</li>
                                <li>Be positive and trustworthy</li>
                                <li>Your colleague depends on you</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-container">
            <div class="image image-full image-radius bg-white" style="padding-bottom: 0; height: 500px;">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/Z8A1TMxR1_I" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>

        <div class="main-container display-flex space-between display-mobile">
            <div class="width width-45 width-mobile padding-bottom-only-mobile">
                <h2 
                    class="ctn-font ctn-micro ctn-min-color ctn-font-primary-semibold" 
                    style="margin-bottom: 30px;">
                    Who We Are
                </h2>
                <p 
                    class="ctn-font ctn-13pt ctn-min-color ctn-line ctn-font-sekunder-thin"
                    style="margin-bottom: 30px;">
                    We are an IT consulting company that has been contributing for more than 4 years in the country. With young professionals, we always innovate to create works. Currently we are trying to develop the company to partner with our overseas clients. as proof of our dedication to continue to contribute in the world of modern technology.
                </p>
                <p 
                    class="ctn-font ctn-13pt ctn-min-color ctn-line ctn-font-sekunder-thin"
                    style="margin-bottom: 5px;">
                    Our vision has brought Digital Informasi Futuristik to become a leading IT company in Indonesia to provide a variety of industry-led mobility solutions. The goal is to empower clients and businesses by creating new possibilities by leveraging today’s and tomorrow’s technology with the highest quality, satisfaction and transparency.
                </p>
            </div>
            <div class="width width-45 width-mobile">
                <h2 
                    class="ctn-font ctn-micro ctn-min-color ctn-font-primary-semibold" 
                    style="margin-bottom: 30px;">
                    What We Do
                </h2>
                <p 
                    class="ctn-font ctn-13pt ctn-min-color ctn-line ctn-font-sekunder-thin"
                    style="margin-bottom: 30px;">
                    Our dedication has led us to become a leading IT company in Indonesia. Become a solution for companies that need information technology such as websites, mobile applications, enterprise systems, e-commerce, etc. And also we become the solution for resource procurement or development team.
                </p>
                <p 
                    class="ctn-font ctn-13pt ctn-min-color ctn-line ctn-font-sekunder-thin"
                    style="margin-bottom: 5px;">
                    Until now we have several products to support and follow the needs in this digital era. Our products provide digital marketing services, social media management, graphic design, product photos, logo creation, video marketing, content creators and digital advertising services.
                </p>
            </div>
        </div>

        <div class="main-container">
            <div class="banner-container border-radius">
                <div class="display-flex space-between align-center display-mobile">
                    <div class="width width-45 width-mobile padding-bottom-only-mobile">
                        <div class="width width-60 width-mobile width-center">
                            <div>
                                <div 
                                    class="image image-all image-radius" 
                                    style="background-image: url({{ asset('img/sites/logo.png') }})"></div>
                            </div>
                        </div>
                    </div>
                    <div class="width width-45 width-mobile">
                        <h2 class="ctn-font ctn-32pt ctn-white-color ctn-font-primary-semibold">
                            Do The Best and <br> Get Things Done
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-container">
            <div class="frm-article no-hover">
                <div style="padding: 30px;">
                    <h2 
                        class="ctn-font ctn-micro ctn-min-color ctn-font-primary-semibold" 
                        style="margin-bottom: 30px;">
                        RELIABLE IT SOLUTION PARTNER
                    </h2>
                    <div class="display-flex space-between align-center display-mobile">
                        <div class="width width-60 width-mobile padding-bottom-only-mobile">
                            <div style="padding: 30px; border-left: 4px #13aff0 solid;">
                                <div class="ctn-font ctn-13pt ctn-min-color ctn-line ctn-font-sekunder-thin">
                                    <i>“ We always build the trust value from the customers by paying attention to the quality of our services, products, processes to maximum work results.”</i>
                                </div>
                            </div>
                        </div>
                        <div class="width width-30 width-mobile">
                            <a 
                                href="{{ url('/contacts') }}" 
                                class="btn btn-main-color btn-radius">
                                Contact Us <i class="icn icn-right fa fa-lg fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection