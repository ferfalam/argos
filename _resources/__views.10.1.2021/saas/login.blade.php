<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title>Se Connecter | {{ ucwords($global->company_name) }}</title>
    <!--@lang('app.login') -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $global->favicon_url }}">
    <meta name="msapplication-TileImage" content="{{ $global->favicon_url }}">
    <meta name='robots' content='noindex, nofollow' />
    <link href="{{ asset('front/plugin/froiden-helper/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('front/plugin/froiden-helper/helper.css') }}" rel="stylesheet">
    <style>
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 .07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>
    <link rel='stylesheet' href="{{ asset('umar/css/dist-block-library-style.min.css') }}">
    <link rel='stylesheet' href="{{ asset('umar/css/shadepro-assets-css-font-circular-std.css') }}">
    <link rel='stylesheet' href="{{ asset('umar/css/shadepro-assets-css-all.min.css') }}">
    <link rel='stylesheet' href="{{ asset('umar/css/shadepro-assets-css-bootstrap.min.css') }}">
    <link rel='stylesheet' href="{{ asset('umar/css/shadepro-assets-css-nice-select.min.css') }}">
    <link rel='stylesheet' href="{{ asset('umar/css/shadepro-assets-css-meanmenu.min.css') }}">
    <link rel='stylesheet' href="{{ asset('umar/css/shadepro-assets-css-select2.min.css') }}">
    <link rel='stylesheet' href="{{ asset('umar/css/shadepro-assets-css-core.css') }}">
    <link rel='stylesheet' href="{{ asset('umar/css/shadepro-assets-css-gutenberg.css') }}">
    <link rel='stylesheet' href="{{ asset('umar/css/shadepro-assets-css-shadepro-style.css') }}">
    <link rel='stylesheet' href="{{ asset('umar/css/shadepro-style.css') }}">
    <link rel='stylesheet' href="{{ asset('umar/css/shadepro-assets-css-shadepro-responsive.css') }}">
    <link rel='stylesheet' href="{{ asset('umar/css/elementor-assets-lib-eicons-css-elementor-icons.min.css') }}">
    <link rel='stylesheet' href="{{ asset('umar/css/elementor-assets-css-frontend.min.css') }}">
    <style id='elementor-frontend-inline-css'>
        @font-face {
            font-family: eicons;
            src: url(https://design.bywalteks.com/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.eot?5.10.0);
            src: url(https://design.bywalteks.com/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.eot?5.10.0#iefix) format("embedded-opentype"), url(https://design.bywalteks.com/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.woff2?5.10.0) format("woff2"), url(https://design.bywalteks.com/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.woff?5.10.0) format("woff"), url(https://design.bywalteks.com/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.ttf?5.10.0) format("truetype"), url(https://design.bywalteks.com/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.svg?5.10.0#eicon) format("svg");
            font-weight: 400;
            font-style: normal
        }
    </style>
    <link rel='stylesheet' href="{{ asset('umar/css/elementor-pro-assets-css-frontend.min.css') }}">
    <link rel='stylesheet' href="{{ asset('umar/css/elementor-css-post-5.css') }}">
    <link rel='stylesheet' href="{{ asset('umar/css/elementor-css-global.css') }}">
    <link rel='stylesheet' href="{{ asset('umar/css/elementor-css-post-20.css') }}">
    <link rel='stylesheet' href="{{ asset('umar/css/6764.css') }}">
    <script src="{{ asset('umar/js/jquery.min.js') }}" id='jquery-core-js'></script>
    <script src="{{ asset('umar/js/jquery-migrate.min.js') }}" id='jquery-migrate-js'></script>

    <style id="wp-custom-css">
        #frg {
            display: flex;
            margin-left: auto;
            justify-content: flex-end;
            padding-bottom: 25px;
            color: #7a7a7a;
            font-weight: 700;
        }

        #lgo-btn {
            max-height: 50px;
            margin: auto;
            max-width: 700px;
            min-height: 50px;
            font-weight: 400;
            font-size: 16px;
        }

        #dd-none {
            display: none;
        }

        #mutli .e-form__indicators__indicator {
            padding-right: 0px;
            padding-left: 0px;

        }

        button[type=submit]{
            background: #00A2F2;
        }

        :root{
            --accent-color: #00A2F2;
        }

        #mutli .e-form__indicators__indicator i {
            color: #fff;

        }

        #mutli .e-form__indicators__indicator--shape-circle {
            margin-top: 13px;
            border: 2px solid;
        }

        #mutli .e-form__indicators__indicator--state-active i {
            color: #00A2F2;
            background-color: #00A2F2;
            border-radius: 50%;
            height: 18px;
        }

        #mutli .e-form__indicators__indicator--state-completed .e-form__indicators__indicator--shape-circle {
            background-color: #fff;
            border: 2px solid #00A2F2;
        }

        #mutli .e-form__indicators__indicator--state-completed i {
            color: #00A2F2;
            background-color: #00A2F2;
            border-radius: 50%;
            height: 18px;
        }



        .elementor-subgroup-inline .elementor-field-option input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        #mutli .elementor-subgroup-inline {
            margin: 20px 0px;
        }

        .elementor-subgroup-inline .elementor-field-option input[type="radio"]+label {

            border: 1px solid #ddd;
            padding: 15px 30px;
            margin: 10px;
            border-radius: 10px;
            width: 100px;
            text-align: center;
            color: #DBD7F4;

        }

        .elementor-field-option .elementor-acceptance-field+label {
            color: #aaa !important;
            font-weight: 400;
        }

        .elementor-field-option .elementor-acceptance-field+label a {
            color: #aaa !important;
            font-weight: 500;
        }

        .elementor-field-type-html p {
            color: #aaa;
        }

        .elementor-heading-title{
            font-size: 28px !important;
            font-weight: 400 !important;
            font-family: "Roboto", sans-serif;
        }

        .e-form__indicators--type-icon {
            width: 230px;
        }

        #mutli .elementor-subgroup-inline .elementor-field-option input[type="radio"]:checked+label {
            border: 1px solid #00A2F2;
            color: #00A2F2;
        }




        .elementor-section-wrap{
            min-height: max-content;
            height: 100vh !important;
        }


        #mutli .elementor-field-type-acceptance .elementor-field-option {
            align-content: center;
            align-self: center;
            display: flex;
        }

        #mutli .elementor-field-type-acceptance .elementor-field-option input[type="checkbox"] {
            width: 20px;
            height: 20px;
        }

        .e-form__buttons__wrapper {
            width: 150px;
        }

        .e-form__buttons__wrapper input[type="button"] {
            border-radius: 8px;
        }

        .e-form__buttons__wrapper {
            width: 150px;
        }

        .elementor-field-type-submit .e-form__buttons__wrapper__button {
            font-size: 15px;
            height: 48px;
            font-weight: 400;
        }

        @media screen and (max-width:769px) {
            #mutli .elementor-subgroup-inline .elementor-field-option {
                display: block;
                margin-bottom: 35px;
            }

            #mutli .elementor-subgroup-inline {
                margin-bottom: 0px;
            }

            #mutli .elementor-field-type-acceptance .elementor-field-option input[type="checkbox"] {
                width: 40px;
                height: 40px;
            }

        }

        .form-control {
            background-color: #f3f3f3 !important;
        }

        h2 {
            font-size: 36px !important;
            font-weight: 900 !important;
        }

        .form-control{
            background: white !important;
        }

        .elementor-form-container{
            width: 40% !important;
            background: #e5e5e5; 
        }

        @media only screen and (max-width : 768px){
            .elementor-form-container{
                width: 100% !important;
                background: #e5e5e5; 
            }
        }

    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
</head>

<body
    class="page-template page-template-elementor_canvas page page-id-20 no-sidebar elementor-default elementor-template-canvas elementor-kit-5 elementor-page elementor-page-20">
    <div data-elementor-type="wp-page" data-elementor-id="20" class="elementor elementor-20"
        data-elementor-settings="[]">
        <div class="elementor-section-wrap">
            <section style="height: 100%; min-height : max-content"
                class="elementor-section elementor-top-section elementor-element elementor-element-49e7ee36 elementor-section-full_width elementor-section-height-default elementor-section-height-default"
                data-id="49e7ee36" data-element_type="section">
                <div class="elementor-container elementor-column-gap-default" style="height: 100%">
                    <div class="elementor-column elementor-col-60 elementor-top-column elementor-element elementor-element-233fda0b elementor-hidden-phone"
                        data-id="233fda0b" data-element_type="column"
                        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                        <div class="elementor-widget-wrap elementor-element-populated"
                            style="background: url({{asset('img/login-page-img.png')}}); background-repeat : no-repeat; background-size: cover; ">
                            <section
                                class="elementor-section elementor-inner-section elementor-element elementor-element-22638214 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="22638214" data-element_type="section">
                                <div class="elementor-container elementor-column-gap-default">
                                    <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-8e4e229 elementor-hidden-phone"
                                        data-id="8e4e229" data-element_type="column"
                                        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-2b37dda7 elementor-widget elementor-widget-image"
                                                data-id="2b37dda7" data-element_type="widget"
                                                data-widget_type="image.default">
                                                <div class="elementor-widget-container">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                    <div 
                        class="elementor-form-container elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-3810ba46"
                        data-id="3810ba46" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <section
                                class="elementor-section elementor-inner-section elementor-element elementor-element-4339ac69 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="4339ac69" data-element_type="section">
                                <div class="elementor-container elementor-column-gap-default">
                                    <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-4dcea4a0"
                                        data-id="4dcea4a0" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-2631e9e1 elementor-widget elementor-widget-heading"
                                                data-id="2631e9e1" data-element_type="widget"
                                                data-widget_type="heading.default">

                                                <div style="text-align: center; margin-bottom:100px;">
                                                    <a href="{{ route('front.home') }}">
                                                        <img width="292" height="152" src="{{ $setting->logo_front_url }}"
                                                            class="attachment-large size-large" alt="" loading="lazy" />
                                                    </a>
                                                </div>

                                                <div class="elementor-widget-container">
                                                    <h2 class="elementor-heading-title elementor-size-default text-center">
                                                        Connectez-vous à votre compte</h2>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-8c9feb7 elementor-widget elementor-widget-form"
                                                data-id="8c9feb7" data-element_type="widget"
                                                data-settings="{&quot;step_next_label&quot;:&quot;Next&quot;,&quot;step_previous_label&quot;:&quot;Previous&quot;,&quot;button_width&quot;:&quot;100&quot;,&quot;step_type&quot;:&quot;number_text&quot;,&quot;step_icon_shape&quot;:&quot;circle&quot;}"
                                                data-widget_type="form.default">
                                                <div class="elementor-widget-container">
                                                    @if (session('message'))
                                                    <div class="alert alert-danger m-t-10">
                                                        {{ session('message') }}
                                                    </div>
                                                    @endif
                                                    <form class="form-horizontal form-material" id="loginform"
                                                        action="{{ route('login') }}" method="POST">
                                                        {{ csrf_field() }}


                                                        @if (session('message'))
                                                        <div class="alert alert-danger m-t-10">
                                                            {{ session('message') }}
                                                        </div>
                                                        @endif

                                                        <div
                                                            class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                                            <div class="col-xs-12">
                                                                <input class="form-control" id="email" type="email"
                                                                    name="email" value="{{ old('email') }}" autofocus
                                                                    required="" placeholder="Entrez votre email ici">
                                                                <!--placeholder="@lang('app.email')"-->

                                                                {{-- @if ($errors->has('email'))--}}
                                                                {{-- <div class="help-block with-errors">--}}
                                                                    {{-- {{ $errors->first('email') }}</div>--}}
                                                                {{-- @endif--}}

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-xs-12">
                                                                <input class="form-control" id="password"
                                                                    type="password" name="password" required=""
                                                                    placeholder="Entrez votre mot de passe ici">
                                                                @if ($errors->has('password'))
                                                                <div class="help-block with-errors">
                                                                    {{ $errors->first('password') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @if ($global->google_recaptcha_status)
                                                        <div
                                                            class="form-group {{ $errors->has('g-recaptcha-response') ? 'has-error' : '' }}">
                                                            <div class="col-xs-12">
                                                                <div class="g-recaptcha"
                                                                    data-sitekey="{{ $global->google_recaptcha_key }}">
                                                                </div>
                                                                @if ($errors->has('g-recaptcha-response'))
                                                                <div class="help-block with-errors">
                                                                    {{ $errors->first('g-recaptcha-response') }}
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="form-group">
                                                            <div class="col-xs-12">
                                                                <div class="checkbox checkbox-primary float-left p-t-0">
                                                                    <input id="checkbox-signup" type="checkbox"
                                                                        name="remember" {{ old('remember') ? 'checked'
                                                                        : '' }}>
                                                                    <label for="checkbox-signup" class="text-dark">
                                                                        Se souvenir de moi
                                                                        <!--@lang('app.rememberMe')-->
                                                                    </label>
                                                                </div>
                                                                <a href="{{ route('password.request') }}"
                                                                    class="text-dark float-right"><i
                                                                        class="fa fa-lock m-r-5"></i>
                                                                    Mot de passe oublié?
                                                                    <!--@lang('app.forgotPassword')?-->
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="form-group text-center m-t-20">
                                                            <div class="col-xs-12">
                                                                <button
                                                                    class="btn btn-primary btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light"
                                                                    type="submit">
                                                                    Se Connecter
                                                                    <!--@lang('app.login')-->
                                                                </button>
                                                            </div>
                                                        </div>


                                                    </form>
                                                    <script src="{{ asset('saas/vendor/jquery/jquery.min.js') }}">
                                                    </script>
                                                    <script
                                                        src="{{ asset('saas/vendor/bootstrap/js/bootstrap.bundle.min.js') }}">
                                                    </script>
                                                    <script src="{{ asset('saas/vendor/slick/slick.min.js') }}">
                                                    </script>
                                                    <script src="{{ asset('saas/vendor/wowjs/wow.min.js') }}"></script>
                                                    <script src="{{ asset('front/plugin/froiden-helper/helper.js') }}">
                                                    </script>
                                                    <script src="{{ asset('saas/js/main.js') }}"></script>
                                                    <script src="{{ asset('front/plugin/froiden-helper/helper.js') }}">
                                                    </script>
                                                    <!-- Global Required JS -->

                                                    <script>
                                                        $('#save-form').click(function() {


                                                        $.easyAjax({
                                                            url: '{{ route('front.signup.store') }}',
                                                            container: '.form-section',
                                                            type: "POST",
                                                            data: $('#register').serialize(),
                                                            messagePosition: "inline",
                                                            success: function(response) {
                                                                if (response.status == 'success') {
                                                                    $('#form-box').remove();
                                                                } else if (response.status == 'fail') {
                                                                    @if ($global->google_recaptcha_status)
                                                                    grecaptcha.reset();
                                                                    @endif

                                                                }
                                                            }
                                                        })
                                                    });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section
                                class="elementor-section elementor-inner-section elementor-element elementor-element-64dea6a8 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="64dea6a8" data-element_type="section">
                                @if ($global->enable_register == true)
                                <div class="elementor-container elementor-column-gap-default">
{{-- 
                                    <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-1bd92f3f"
                                        data-id="1bd92f3f" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-7b8ceb3b elementor-widget elementor-widget-heading"
                                                data-id="7b8ceb3b" data-element_type="widget"
                                                data-widget_type="heading.default">
                                                <div class="elementor-widget-container">
                                                    <h6 id="forgot"
                                                        class="elementor-heading-title elementor-size-default">
                                                        <!--@lang('messages.dontHaveAccount')-->
                                                        Vous n’avez pas de compte ?
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-1741565"
                                        data-id="1741565" data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div class="elementor-element elementor-element-3db1f99b elementor-widget elementor-widget-heading"
                                                data-id="3db1f99b" data-element_type="widget"
                                                data-widget_type="heading.default">
                                                <div class="elementor-widget-container">
                                                    <a href="{{ route('front.signup.index') }}">
                                                        <h6 class=" text-primary elementor-size-default">
                                                            S’inscrire maintenant
                                                            <!--@lang('app.signup')-->
                                                        </h6>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                @endif
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <link rel='stylesheet' href='css/elementor-assets-lib-animations-animations.min.css'>
    {{--<script src='js/imagesloaded.min.js' id='imagesloaded-js'></script>--}}
    {{--<script src='js/masonry.min.js' id='masonry-js'></script>--}}
    {{--<script src='js/jquery.nice-select.min.js' id='nice-select-js'></script>--}}
    {{--<script src='js/jquery.meanmenu.min.js' id='meanmenu-js-js'></script>--}}
    {{--<script src='js/select2.min.js' id='select2-js'></script>--}}
    {{--<script src='js/shadepro-main.js' id='shadepro-main-js'></script>--}}
    {{--<script src='js/wp-embed.min.js' id='wp-embed-js'></script>--}}
    {{--<script src='js/webpack.runtime.min.js' id='elementor-webpack-runtime-js'></script>--}}
    {{--<script src='js/frontend-modules.min.js' id='elementor-frontend-modules-js'></script>--}}
    {{--<script src='js/jquery.sticky.min.js' id='elementor-sticky-js'></script>--}}
    {{--<script src='js/frontend.min.js' id='elementor-pro-frontend-js'></script>--}}
    {{--<script src='js/waypoints.min.js' id='elementor-waypoints-js'></script>--}}
    {{--<script src='js/core.min.js' id='jquery-ui-core-js'></script>--}}
    {{--<script src='js/swiper.min.js' id='swiper-js'></script>--}}
    {{--<script src='js/share-link.min.js' id='share-link-js'></script>--}}
    {{--<script src='js/dialog.min.js' id='elementor-dialog-js'></script>--}}
    {{--<script id='elementor-frontend-js-before'>
        --}}
{{--    var elementorFrontendConfig = {--}}
{{--        "environmentMode": {--}}
{{--            "edit": false,--}}
{{--            "wpPreview": false,--}}
{{--            "isScriptDebug": false--}}
{{--        },--}}
{{--        "i18n": {--}}
{{--            "shareOnFacebook": "Share on Facebook",--}}
{{--            "shareOnTwitter": "Share on Twitter",--}}
{{--            "pinIt": "Pin it",--}}
{{--            "download": "Download",--}}
{{--            "downloadImage": "Download image",--}}
{{--            "fullscreen": "Fullscreen",--}}
{{--            "zoom": "Zoom",--}}
{{--            "share": "Share",--}}
{{--            "playVideo": "Play Video",--}}
{{--            "previous": "Previous",--}}
{{--            "next": "Next",--}}
{{--            "close": "Close"--}}
{{--        },--}}
{{--        "is_rtl": false,--}}
{{--        "breakpoints": {--}}
{{--            "xs": 0,--}}
{{--            "sm": 480,--}}
{{--            "md": 768,--}}
{{--            "lg": 1025,--}}
{{--            "xl": 1440,--}}
{{--            "xxl": 1600--}}
{{--        },--}}
{{--        "responsive": {--}}
{{--            "breakpoints": {--}}
{{--                "mobile": {--}}
{{--                    "label": "Mobile",--}}
{{--                    "value": 767,--}}
{{--                    "direction": "max",--}}
{{--                    "is_enabled": true,--}}
{{--                    "default_value": 767--}}
{{--                },--}}
{{--                "mobile_extra": {--}}
{{--                    "label": "Mobile Extra",--}}
{{--                    "value": 880,--}}
{{--                    "direction": "max",--}}
{{--                    "is_enabled": false,--}}
{{--                    "default_value": 880--}}
{{--                },--}}
{{--                "tablet": {--}}
{{--                    "label": "Tablet",--}}
{{--                    "value": 1024,--}}
{{--                    "direction": "max",--}}
{{--                    "is_enabled": true,--}}
{{--                    "default_value": 1024--}}
{{--                },--}}
{{--                "tablet_extra": {--}}
{{--                    "label": "Tablet Extra",--}}
{{--                    "value": 1365,--}}
{{--                    "direction": "max",--}}
{{--                    "is_enabled": false,--}}
{{--                    "default_value": 1365--}}
{{--                },--}}
{{--                "laptop": {--}}
{{--                    "label": "Laptop",--}}
{{--                    "value": 1620,--}}
{{--                    "direction": "max",--}}
{{--                    "is_enabled": false,--}}
{{--                    "default_value": 1620--}}
{{--                },--}}
{{--                "widescreen": {--}}
{{--                    "label": "Widescreen",--}}
{{--                    "value": 2400,--}}
{{--                    "direction": "min",--}}
{{--                    "is_enabled": false,--}}
{{--                    "default_value": 2400--}}
{{--                }--}}
{{--            }--}}
{{--        },--}}
{{--        "version": "3.3.1",--}}
{{--        "is_static": false,--}}
{{--        "experimentalFeatures": {--}}
{{--            "e_dom_optimization": true,--}}
{{--            "a11y_improvements": true,--}}
{{--            "e_import_export": true,--}}
{{--            "landing-pages": true,--}}
{{--            "elements-color-picker": true,--}}
{{--            "admin-top-bar": true--}}
{{--        },--}}
{{--        "urls": {--}}
{{--            "assets": "https:\/\/design.bywalteks.com\/wp-content\/plugins\/elementor\/assets\/"--}}
{{--        },--}}
{{--        "settings": {--}}
{{--            "page": [],--}}
{{--            "editorPreferences": []--}}
{{--        },--}}
{{--        "kit": {--}}
{{--            "active_breakpoints": ["viewport_mobile", "viewport_tablet"],--}}
{{--            "global_image_lightbox": "yes",--}}
{{--            "lightbox_enable_counter": "yes",--}}
{{--            "lightbox_enable_fullscreen": "yes",--}}
{{--            "lightbox_enable_zoom": "yes",--}}
{{--            "lightbox_enable_share": "yes",--}}
{{--            "lightbox_title_src": "title",--}}
{{--            "lightbox_description_src": "description"--}}
{{--        },--}}
{{--        "post": {--}}
{{--            "id": 20,--}}
{{--            "title": "Login%20%E2%80%93%20Design%20by%20Walteks",--}}
{{--            "excerpt": "",--}}
{{--            "featuredImage": false--}}
{{--        }--}}
{{--    };--}}
{{--
    </script>--}}
    {{--<script src='js/frontend.min.js' id='elementor-frontend-js'></script>--}}
    {{--<script src='js/preloaded-modules.min.js' id='preloaded-modules-js'></script>--}}
    <script>
        $(document).ready(function () {
        @if ($errors->has('email'))
        document.getElementById("email").setCustomValidity('{{ $errors->first('email') }}');
        var applicationForm = document.getElementById("loginform");
        applicationForm.reportValidity();
        @endif
    });
    $('#password').blur(function () {
        // alert('test');
        removeValidation();
    });
    function removeValidation(){
        document.getElementById("email").setCustomValidity('');
    }
    </script>
    <style>
        #forgot {
            color: #6c757d !important;
        }
    </style>
</body>

</html>

<!--This file was exported by "Export WP Page to Static HTML" plugin which created by ReCorp (https://myrecorp.com) -->