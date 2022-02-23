{{--@extends('layouts.auth')--}}

{{--@section('content')--}}


{{--    <div class="alert alert-success">--}}
{{--        {!! $message !!}--}}
{{--    </div>--}}
{{--@endsection--}}
        <!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title>Récupérer Mot de Passe | {{ ucwords($global->company_name) }}</title>
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

        #mutli .e-form__indicators__indicator i {
            color: #fff;

        }

        #mutli .e-form__indicators__indicator--shape-circle {
            margin-top: 13px;
            border: 2px solid;
        }

        #mutli .e-form__indicators__indicator--state-active i {
            color: #5541d7;
            background-color: #5541d7;
            border-radius: 50%;
            height: 18px;
        }

        #mutli .e-form__indicators__indicator--state-completed .e-form__indicators__indicator--shape-circle {
            background-color: #fff;
            border: 2px solid #5541d7;
        }

        #mutli .e-form__indicators__indicator--state-completed i {
            color: #5541d7;
            background-color: #5541d7;
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

        .e-form__indicators--type-icon {
            width: 230px;
        }

        #mutli .elementor-subgroup-inline .elementor-field-option input[type="radio"]:checked+label {
            border: 1px solid #5541d7;
            color: #5541d7;
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

    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
</head>

<body
        class="page-template page-template-elementor_canvas page page-id-20 no-sidebar elementor-default elementor-template-canvas elementor-kit-5 elementor-page elementor-page-20">
<div data-elementor-type="wp-page" data-elementor-id="20" class="elementor elementor-20"
     data-elementor-settings="[]">
    <div class="elementor-section-wrap">
        <section
                class="elementor-section elementor-top-section elementor-element elementor-element-49e7ee36 elementor-section-full_width elementor-section-height-default elementor-section-height-default"
                data-id="49e7ee36" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default" style="height: 100vh">

                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-233fda0b elementor-hidden-phone"
                     data-id="233fda0b" data-element_type="column"
                     data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-widget-wrap elementor-element-populated" style="background-color: white">
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
                                                                                        <a href="{{ route('front.home') }}">
                                                                                            <img width="292" height="152"
                                                                                                 src="{{ $setting->logo_front_url }}"
                                                                                                 class="attachment-large size-large" alt="" loading="lazy" />
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                        <div class="elementor-element elementor-element-78627d99 elementor-widget elementor-widget-image"
                                             data-id="78627d99" data-element_type="widget"
                                             data-widget_type="image.default" style="top: 50%">
                                            <div class="elementor-widget-container">
                                                    <div class="alert alert-success">
                                                        {!! $message !!}
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-233fda0b elementor-hidden-phone"
                     data-id="233fda0b" data-element_type="column"
                     data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <section
                                class="elementor-section elementor-inner-section elementor-element elementor-element-22638214 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="22638214" data-element_type="section">
                            <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-8e4e229 elementor-hidden-phone"
                                     data-id="8e4e229" data-element_type="column"
                                     data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                    <div class="elementor-widget-wrap elementor-element-populated">
{{--                                        <div class="elementor-element elementor-element-2b37dda7 elementor-widget elementor-widget-image"--}}
{{--                                             data-id="2b37dda7" data-element_type="widget"--}}
{{--                                             data-widget_type="image.default">--}}
{{--                                            <div class="elementor-widget-container">--}}
{{--                                                <a href="{{ route('front.home') }}">--}}
{{--                                                    <img width="292" height="152"--}}
{{--                                                         src="{{ $setting->logo_front_url }}"--}}
{{--                                                         class="attachment-large size-large" alt="" loading="lazy" />--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="elementor-element elementor-element-78627d99 elementor-widget elementor-widget-image"
                                             data-id="78627d99" data-element_type="widget"
                                             data-widget_type="image.default" style="top: 50%">
                                            <div class="elementor-widget-container">
                                                @if (session('status'))
                                                    <img width="557" height="702"
                                                         src="{{ asset('/umar/images/Illustration-2.png') }}"
                                                         class="attachment-full size-full" alt="" loading="lazy"
                                                         srcset="{{ asset('/umar/images/Illustration-2.png') }} 557w, {{ asset('/umar/images/Illustration-2.png') }} 238w"
                                                         sizes="(max-width: 557px) 100vw, 557px" />
                                                @else

                                                    <img width="557" height="702"
                                                         src="{{ asset('/umar/images/Group.png') }}"
                                                         class="attachment-full size-full" alt="" loading="lazy"
                                                         srcset="{{ asset('/umar/images/Group.png') }} 557w, {{ asset('/umar/images/Group.png') }} 238w"
                                                         sizes="(max-width: 557px) 100vw, 557px" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
{{--<link rel='stylesheet' href='css/elementor-assets-lib-animations-animations.min.css'>--}}
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
{{--<script id='elementor-pro-frontend-js-before'>--}}
{{--    var ElementorProFrontendConfig = {--}}
{{--        "ajaxurl": "https:\/\/design.bywalteks.com\/wp-admin\/admin-ajax.php",--}}
{{--        "nonce": "7ef93f0221",--}}
{{--        "i18n": {--}}
{{--            "toc_no_headings_found": "No headings were found on this page."--}}
{{--        },--}}
{{--        "shareButtonsNetworks": {--}}
{{--            "facebook": {--}}
{{--                "title": "Facebook",--}}
{{--                "has_counter": true--}}
{{--            },--}}
{{--            "twitter": {--}}
{{--                "title": "Twitter"--}}
{{--            },--}}
{{--            "google": {--}}
{{--                "title": "Google+",--}}
{{--                "has_counter": true--}}
{{--            },--}}
{{--            "linkedin": {--}}
{{--                "title": "LinkedIn",--}}
{{--                "has_counter": true--}}
{{--            },--}}
{{--            "pinterest": {--}}
{{--                "title": "Pinterest",--}}
{{--                "has_counter": true--}}
{{--            },--}}
{{--            "reddit": {--}}
{{--                "title": "Reddit",--}}
{{--                "has_counter": true--}}
{{--            },--}}
{{--            "vk": {--}}
{{--                "title": "VK",--}}
{{--                "has_counter": true--}}
{{--            },--}}
{{--            "odnoklassniki": {--}}
{{--                "title": "OK",--}}
{{--                "has_counter": true--}}
{{--            },--}}
{{--            "tumblr": {--}}
{{--                "title": "Tumblr"--}}
{{--            },--}}
{{--            "delicious": {--}}
{{--                "title": "Delicious"--}}
{{--            },--}}
{{--            "digg": {--}}
{{--                "title": "Digg"--}}
{{--            },--}}
{{--            "skype": {--}}
{{--                "title": "Skype"--}}
{{--            },--}}
{{--            "stumbleupon": {--}}
{{--                "title": "StumbleUpon",--}}
{{--                "has_counter": true--}}
{{--            },--}}
{{--            "mix": {--}}
{{--                "title": "Mix"--}}
{{--            },--}}
{{--            "telegram": {--}}
{{--                "title": "Telegram"--}}
{{--            },--}}
{{--            "pocket": {--}}
{{--                "title": "Pocket",--}}
{{--                "has_counter": true--}}
{{--            },--}}
{{--            "xing": {--}}
{{--                "title": "XING",--}}
{{--                "has_counter": true--}}
{{--            },--}}
{{--            "whatsapp": {--}}
{{--                "title": "WhatsApp"--}}
{{--            },--}}
{{--            "email": {--}}
{{--                "title": "Email"--}}
{{--            },--}}
{{--            "print": {--}}
{{--                "title": "Print"--}}
{{--            },--}}
{{--            "weixin": {--}}
{{--                "title": "WeChat"--}}
{{--            },--}}
{{--            "weibo": {--}}
{{--                "title": "Weibo"--}}
{{--            }--}}
{{--        },--}}
{{--        "facebook_sdk": {--}}
{{--            "lang": "en_US",--}}
{{--            "app_id": ""--}}
{{--        },--}}
{{--        "lottie": {--}}
{{--            "defaultAnimationUrl": "https:\/\/design.bywalteks.com\/wp-content\/plugins\/elementor-pro\/modules\/lottie\/assets\/animations\/default.json"--}}
{{--        }--}}
{{--    };--}}
{{--</script>--}}
{{--<script src='js/frontend.min.js' id='elementor-pro-frontend-js'></script>--}}
{{--<script src='js/waypoints.min.js' id='elementor-waypoints-js'></script>--}}
{{--<script src='js/core.min.js' id='jquery-ui-core-js'></script>--}}
{{--<script src='js/swiper.min.js' id='swiper-js'></script>--}}
{{--<script src='js/share-link.min.js' id='share-link-js'></script>--}}
{{--<script src='js/dialog.min.js' id='elementor-dialog-js'></script>--}}
<script>
    $(document).ready(function () {
        @if ($errors->has('email'))
        document.getElementById("email").setCustomValidity('{{ $errors->first('email') }}');
        var applicationForm = document.getElementById("loginform");
        applicationForm.reportValidity();
        @endif
    });
    $('#email').blur(function () {
        // alert('test');
        removeValidation();
    });
    function removeValidation(){
        document.getElementById("email").setCustomValidity('');
    }
</script>
{{--<script src='js/frontend.min.js' id='elementor-frontend-js'></script>--}}
{{--<script src='js/preloaded-modules.min.js' id='preloaded-modules-js'></script>--}}
</body>

</html>

<!--This file was exported by "Export WP Page to Static HTML" plugin which created by ReCorp (https://myrecorp.com) -->

