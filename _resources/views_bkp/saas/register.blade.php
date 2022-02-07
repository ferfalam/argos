<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title>Inscription | {{ ucwords($global->company_name) }}</title>
    <meta name='robots' content='noindex, nofollow'/>
    <link rel='stylesheet' href="{{ asset('/umar/css/dist-block-library-style.min.css') }}">
    <link rel='stylesheet' href="{{ asset('/umar/css/shadepro-assets-css-font-circular-std.css') }}">
    <link rel='stylesheet' href="{{ asset('/umar/css/shadepro-assets-css-all.min.css') }}">
    <link rel='stylesheet' href="{{ asset('/umar/css/shadepro-assets-css-bootstrap.min.css') }}">
    <link rel='stylesheet' href="{{ asset('/umar/css/shadepro-assets-css-nice-select.min.css') }}">
    <link rel='stylesheet' href="{{ asset('/umar/css/shadepro-assets-css-meanmenu.min.css') }}">
    <link rel='stylesheet' href="{{ asset('/umar/css/shadepro-assets-css-select2.min.css') }}">
    <link rel='stylesheet' href="{{ asset('/umar/css/shadepro-assets-css-core.css') }}">
    <link rel='stylesheet' href="{{ asset('/umar/css/shadepro-assets-css-gutenberg.css') }}">
    <link rel='stylesheet' href="{{ asset('/umar/css/shadepro-assets-css-shadepro-style.css') }}">
    <link rel='stylesheet' href="{{ asset('/umar/css/shadepro-style.css') }}">
    <link rel='stylesheet' href="{{ asset('/umar/css/shadepro-assets-css-shadepro-responsive.css') }}">
    <link rel='stylesheet'
          href="{{ asset('/umar/css/elementor-assets-lib-eicons-css-elementor-icons.min.css') }}">
    <link rel='stylesheet' href="{{ asset('/umar/css/elementor-assets-css-frontend.min.css') }}">
    <style id="elementor-frontend-inline-css' ) }}">
        @font-face {
            font-family: eicons;
            src: url(https://design.bywalteks.com/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.eot?5.10.0);
            src: url(https://design.bywalteks.com/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.eot?5.10.0#iefix) format("embedded-opentype"), url(https://design.bywalteks.com/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.woff2?5.10.0) format("woff2"), url(https://design.bywalteks.com/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.woff?5.10.0) format("woff"), url(https://design.bywalteks.com/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.ttf?5.10.0) format("truetype"), url(https://design.bywalteks.com/wp-content/plugins/elementor/assets/lib/eicons/fonts/eicons.svg?5.10.0#eicon) format("svg");
            font-weight: 400;
            font-style: normal
        }

    </style>
    <link rel='stylesheet' href="{{ asset('/umar/css/elementor-css-post-5.css') }}">
    <link rel='stylesheet' href="{{ asset('/umar/css/elementor-pro-assets-css-frontend.min.css') }}">
    <link rel='stylesheet' href="{{ asset('/umar/css/elementor-css-global.css') }}">
    <link rel='stylesheet' href="{{ asset('/umar/css/elementor-css-post-36.css') }}">
    <link rel='stylesheet' href="{{ asset('/umar/css/8352.css') }}">
    <link rel='stylesheet'
          href="{{ asset('/umar/css/elementor-assets-lib-font-awesome-css-fontawesome.min.css') }}">
    <link rel='stylesheet' href="{{ asset('/umar/css/elementor-assets-lib-font-awesome-css-solid.min.css') }}">
    <script src="{{ asset('/umar/js/jquery.min.js') }}" id="jquery-core-js"></script>
    <script src="{{ asset('/umar/js/jquery-migrate.min.js') }}" id="jquery-migrate-js"></script>
    <script src="https://kit.fontawesome.com/796111d3c7.js" crossorigin="anonymous"></script>
{{--    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}
    <style id="wp-custom-css') }}">
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

        .elementor-subgroup-inline .elementor-field-option input[type="radio"] + label {

            border: 1px solid #ddd;
            padding: 15px 30px;
            margin: 10px;
            border-radius: 10px;
            width: 100px;
            text-align: center;
            color: #DBD7F4;

        }

        .elementor-field-option .elementor-acceptance-field + label {
            color: #aaa !important;
            font-weight: 400;
        }

        .elementor-field-option .elementor-acceptance-field + label a {
            color: #aaa !important;
            font-weight: 500;
        }

        .elementor-field-type-html p {
            color: #aaa;
        }

        .e-form__indicators--type-icon {
            width: 230px;
        }

        #mutli .elementor-subgroup-inline .elementor-field-option input[type="radio"]:checked + label {
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

        @media screen and (max-width: 769px) {
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

        h2, h3 {
            font-size: 36px !important;
            font-weight: 900 !important;
        }

    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"/>
</head>

<body
        class="page-template page-template-elementor_canvas page page-id-36 no-sidebar elementor-default elementor-template-canvas elementor-kit-5 elementor-page elementor-page-36">
<div data-elementor-type="wp-page" data-elementor-id="36" class="elementor elementor-36"
     data-elementor-settings="[]">
    <div class="elementor-section-wrap">
        <section
                class="elementor-section elementor-top-section elementor-element elementor-element-6893876e elementor-section-full_width elementor-section-stretched elementor-section-height-default elementor-section-height-default"
                data-id="6893876e" data-element_type="section"
                data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;}">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-3fb2d532 elementor-hidden-phone"
                     data-id="3fb2d532" data-element_type="column"
                     data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <section
                                class="elementor-section elementor-inner-section elementor-element elementor-element-3c8d052f elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="3c8d052f" data-element_type="section">
                            <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-5ebef59f"
                                     data-id="5ebef59f" data-element_type="column">
                                    <div class="elementor-widget-wrap elementor-element-populated">
                                        <div class="elementor-element elementor-element-2e1cd8d0 elementor-widget elementor-widget-image"
                                             data-id="2e1cd8d0" data-element_type="widget"
                                             data-widget_type="image.default">
                                            <div class="elementor-widget-container">
                                                <a href="{{ route('front.home') }}">
                                                    <img width="292" height="152"
                                                         src="{{ $setting->logo_front_url }}"
                                                         class="attachment-large size-large" alt="" loading="lazy"/>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-1731dd13 elementor-widget elementor-widget-image"
                                             data-id="1731dd13" data-element_type="widget"
                                             data-widget_type="image.default">
                                            <div class="elementor-widget-container">
                                                <img width="419" height="456"
                                                     src="{{ asset('umar/images/Illustration.png') }}"
                                                     class="attachment-medium_large size-medium_large" alt=""
                                                     loading="lazy"
                                                     srcset="{{ asset('umar/images/Illustration.png') }} 419w, {{ asset('umar/images/Illustration.png') }} 276w"
                                                     sizes="(max-width: 419px) 100vw, 419px"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-49c0557e"
                     data-id="49c0557e" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-3d97136 elementor-hidden-desktop elementor-hidden-tablet elementor-widget elementor-widget-image"
                             data-id="3d97136" data-element_type="widget" data-widget_type="image.default">
                            <div class="elementor-widget-container">
                                <img width="292" height="152" src="images/Logo-2-transparent-1.png"
                                     class="attachment-large size-large" alt="" loading="lazy"/>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-4138c485 elementor-button-align-start elementor-widget elementor-widget-form"
                             data-id="4138c485" data-element_type="widget" data-widget_type="form.default">
                            <div class="elementor-widget-container">
                                @if (session('success'))
                                    <div class="alert alert-info m-t-10">
                                        {{ session('success') }}
                                        <meta http-equiv="refresh" content="2;url={{ route('login') }}">
                                    </div>
                                @endif
                                @if (session('message'))
                                    <div class="alert alert-danger m-t-10">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                {!! Form::open(['id' => 'register', 'method' => 'POST']) !!}


                                <span id="step1" style="display: block;">
                                        <div
                                                class="elementor-field-type-html elementor-field-group elementor-column elementor-field-group-name elementor-col-100">
                                            <h3>Inscription</h3>
                                        </div>
                                        <div
                                                class="elementor-field-type-html elementor-field-group elementor-column elementor-field-group-field_e7d5ef4 elementor-col-100">
                                            <p>Pour mieux vous connaitre</p>
                                        </div>
                                        <div
                                                class="elementor-field-type-text elementor-field-group elementor-column  elementor-col-100 elementor-field-required">
                                            <label for="company_name">Nom de l’entreprise</label>
                                            <input type="text" name="company_name" id="company_name" value="{{old('company_name')}}"
                                                   placeholder="Entrez le nom ici"
                                                   class="form-control" autofocus required>
                                        </div>
                                        <div
                                                class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-field_37f2b67 elementor-col-100 elementor-field-required">
                                            <label for="activity_field" class="elementor-field-label">Secteur
                                                d’activité</label>
{{--                                            <input type="text" name="activity_field" id="activity_field"--}}
{{--                                                   placeholder="Dans quel secteur travaillez vous ?"--}}
{{--                                                   class="form-control"--}}
{{--                                                   required>--}}
                                            <select placeholder="Dans quel secteur travaillez vous ?" class="form-control" name="activity_field" id="activity_field">
                                                <option @if(old('activity_field')=='Comptabilité') selected @endif value="Comptabilité">Comptabilité</option>
<option @if(old('activity_field')=='Compagnies aériennes/Aviation') selected @endif value="Compagnies aériennes/Aviation">Compagnies aériennes/Aviation</option>
<option @if(old('activity_field')=='Alternative Dispute Resolution') selected @endif value="Alternative Dispute Resolution">Alternative Dispute Resolution</option>
<option @if(old('activity_field')=='Médecine alternative') selected @endif value="Médecine alternative">Médecine alternative</option>
<option @if(old('activity_field')=='Animation') selected @endif value="Animation">Animation</option>
<option @if(old('activity_field')=='Vêtements/Mode') selected @endif value="Vêtements/Mode">Vêtements/Mode</option>
<option @if(old('activity_field')=='Architecture/Planification') selected @endif value="Architecture/Planification">Architecture/Planification</option>
<option @if(old('activity_field')=='Arts/Artisanat') selected @endif value="Arts/Artisanat">Arts/Artisanat</option>
<option @if(old('activity_field')=='Automobile') selected @endif value="Automobile">Automobile</option>
<option @if(old('activity_field')=='Aviation/Aérospatiale') selected @endif value="Aviation/Aérospatiale">Aviation/Aérospatiale</option>
<option @if(old('activity_field')=='Banque/Hypothèque') selected @endif value="Banque/Hypothèque">Banque/Hypothèque</option>
<option @if(old('activity_field')=='Biotechnologie/Greentech') selected @endif value="Biotechnologie/Greentech">Biotechnologie/Greentech</option>
<option @if(old('activity_field')=='Média de diffusion') selected @endif value="Média de diffusion">Média de diffusion</option>
<option @if(old('activity_field')=='Matériaux de construction') selected @endif value="Matériaux de construction">Matériaux de construction</option>
<option @if(old('activity_field')=='Fournitures/équipements professionnels') selected @endif value="Fournitures/équipements professionnels">Fournitures/équipements professionnels</option>
<option @if(old('activity_field')=='Marchés de Capitaux/Hedge Fund/Private Equity') selected @endif value="Marchés de Capitaux/Hedge Fund/Private Equity">Marchés de Capitaux/Hedge Fund/Private Equity</option>
<option @if(old('activity_field')=='Produits chimiques') selected @endif value="Produits chimiques">Produits chimiques</option>
<option @if(old('activity_field')=='Organisation civique/sociale') selected @endif value="Organisation civique/sociale">Organisation civique/sociale</option>
<option @if(old('activity_field')=='Génie civil') selected @endif value="Génie civil">Génie civil</option>
<option @if(old('activity_field')=='Immobilier commercial') selected @endif value="Immobilier commercial">Immobilier commercial</option>
<option @if(old('activity_field')=='Jeux d\'ordinateur') selected @endif value="Jeux d'ordinateur">Jeux d'ordinateur</option>
<option @if(old('activity_field')=='Matériel informatique') selected @endif value="Matériel informatique">Matériel informatique</option>
<option @if(old('activity_field')=='Réseau informatique') selected @endif value="Réseau informatique">Réseau informatique</option>
<option @if(old('activity_field')=='Logiciel informatique/Ingénierie') selected @endif value="Logiciel informatique/Ingénierie">Logiciel informatique/Ingénierie</option>
<option @if(old('activity_field')=='Sécurité informatique/réseau') selected @endif value="Sécurité informatique/réseau">Sécurité informatique/réseau</option>
<option @if(old('activity_field')=='Construction') selected @endif value="Construction">Construction</option>
<option @if(old('activity_field')=='Électronique grand public') selected @endif value="Électronique grand public">Électronique grand public</option>
<option @if(old('activity_field')=='Biens de consommation') selected @endif value="Biens de consommation">Biens de consommation</option>
<option @if(old('activity_field')=='Services aux consommateurs') selected @endif value="Services aux consommateurs">Services aux consommateurs</option>
<option @if(old('activity_field')=='Cosmétiques') selected @endif value="Cosmétiques">Cosmétiques</option>
<option @if(old('activity_field')=='Laitier') selected @endif value="Laitier">Laitier</option>
<option @if(old('activity_field')=='Défense/Espace') selected @endif value="Défense/Espace">Défense/Espace</option>
<option @if(old('activity_field')=='Conception') selected @endif value="Conception">Conception</option>
<option @if(old('activity_field')=='E-Learning') selected @endif value="E-Learning">E-Learning</option>
<option @if(old('activity_field')=='Gestion de l\'éducation') selected @endif value="Gestion de l'éducation">Gestion de l'éducation</option>
<option @if(old('activity_field')=='Fabrication électrique/électronique') selected @endif value="Fabrication électrique/électronique">Fabrication électrique/électronique</option>
<option @if(old('activity_field')=='Divertissement/Production de film') selected @endif value="Divertissement/Production de film">Divertissement/Production de film</option>
<option @if(old('activity_field')=='Services environnementaux') selected @endif value="Services environnementaux">Services environnementaux</option>
<option @if(old('activity_field')=='Services d\'événements') selected @endif value="Services d'événements">Services d'événements</option>
<option @if(old('activity_field')=='Bureau Exécutif') selected @endif value="Bureau Exécutif">Bureau Exécutif</option>
<option @if(old('activity_field')=='Services des installations') selected @endif value="Services des installations">Services des installations</option>
<option @if(old('activity_field')=='Agriculture') selected @endif value="Agriculture">Agriculture</option>
<option @if(old('activity_field')=='Services financiers') selected @endif value="Services financiers">Services financiers</option>
<option @if(old('activity_field')=='Beaux-arts') selected @endif value="Beaux-arts">Beaux-arts</option>
<option @if(old('activity_field')=='Pêche') selected @endif value="Pêche">Pêche</option>
<option @if(old('activity_field')=='Production alimentaire') selected @endif value="Production alimentaire">Production alimentaire</option>
<option @if(old('activity_field')=='Nourriture/Boissons') selected @endif value="Nourriture/Boissons">Nourriture/Boissons</option>
<option @if(old('activity_field')=='Levée de fonds') selected @endif value="Levée de fonds">Levée de fonds</option>
<option @if(old('activity_field')=='Meubles') selected @endif value="Meubles">Meubles</option>
<option @if(old('activity_field')=='Jeux/Casinos') selected @endif value="Jeux/Casinos">Jeux/Casinos</option>
<option @if(old('activity_field')=='Verre/Céramique/Béton') selected @endif value="Verre/Céramique/Béton">Verre/Céramique/Béton</option>
<option @if(old('activity_field')=='Administration gouvernementale') selected @endif value="Administration gouvernementale">Administration gouvernementale</option>
<option @if(old('activity_field')=='Relations gouvernementales') selected @endif value="Relations gouvernementales">Relations gouvernementales</option>
<option @if(old('activity_field')=='Conception graphique/Conception Web') selected @endif value="Conception graphique/Conception Web">Conception graphique/Conception Web</option>
<option @if(old('activity_field')=='Santé/Fitness') selected @endif value="Santé/Fitness">Santé/Fitness</option>
<option @if(old('activity_field')=='Enseignement supérieur/Académie') selected @endif value="Enseignement supérieur/Académie">Enseignement supérieur/Académie</option>
<option @if(old('activity_field')=='Hôpital/Soins') selected @endif value="Hôpital/Soins de santé">Hôpital/Soins de santé</option>
<option @if(old('activity_field')=='Hospitalité') selected @endif value="Hospitalité">Hospitalité</option>
<option @if(old('activity_field')=='Ressources Humaines/RH') selected @endif value="Ressources Humaines/RH">Ressources Humaines/RH</option>
<option @if(old('activity_field')=='Import/Export') selected @endif value="Import/Export">Import/Export</option>
<option @if(old('activity_field')=='Services individuels/familiaux') selected @endif value="Services individuels/familiaux">Services individuels/familiaux</option>
<option @if(old('activity_field')=='Industrial Automation') selected @endif value="Industrial Automation">Industrial Automation</option>
<option @if(old('activity_field')=='Services d\'information') selected @endif value="Services d'information">Services d'information</option>
<option @if(old('activity_field')=='Technologies de l\'information/TI') selected @endif value="Technologies de l'information/TI">Technologies de l'information/TI</option>
<option @if(old('activity_field')=='Assurance') selected @endif value="Assurance">Assurance</option>
<option @if(old('activity_field')=='Affaires internationales') selected @endif value="Affaires internationales">Affaires internationales</option>
<option @if(old('activity_field')=='"Commerce/Développement International') selected @endif value="Commerce/Développement International">Commerce/Développement International</option>
<option @if(old('activity_field')=='Internet') selected @endif value="Internet">Internet</option>
<option @if(old('activity_field')=='Banque d\'investissement/Venture') selected @endif value="Banque d'investissement/Venture">Banque d'investissement/Vente</option>
<option @if(old('activity_field')=='Gestion d\'investissement/Hedge Fund/Private Equity') selected @endif value="Gestion d'investissement/Hedge Fund/Private Equity">Gestion d'investissement/Hedge Fund/Private Equity</option>
<option @if(old('activity_field')=='judiciaire') selected @endif value="judiciaire">judiciaire</option>
<option @if(old('activity_field')=='Application de la loi') selected @endif value="Application de la loi">Application de la loi</option>
<option @if(old('activity_field')=='Cabinets d\'avocats/Cabinets d\'avocats') selected @endif value="Cabinets d'avocats/Cabinets d'avocats">Cabinets d'avocats/Cabinets d'avocats</option>
<option @if(old('activity_field')=='Services juridiques') selected @endif value="Services juridiques">Services juridiques</option>
<option @if(old('activity_field')=='Bureau législatif') selected @endif value="Bureau législatif">Bureau législatif</option>
<option @if(old('activity_field')=='Loisirs/Voyages') selected @endif value="Loisirs/Voyages">Loisirs/Voyages</option>
<option @if(old('activity_field')=='Bibliothèque') selected @endif value="Bibliothèque">Bibliothèque</option>
<option @if(old('activity_field')=='Logistique/Approvisionnement') selected @endif value="Logistique/Approvisionnement">Logistique/Approvisionnement</option>
<option @if(old('activity_field')=='Articles de luxe/Bijoux') selected @endif value="Articles de luxe/Bijoux">Articles de luxe/Bijoux</option>
<option @if(old('activity_field')=='Machinery') selected @endif value="Machinery">Machines</option>
<option @if(old('activity_field')=='Conseil en gestion') selected @endif value="Conseil en gestion">Conseil en gestion</option>
<option @if(old('activity_field')=='Maritime') selected @endif value="Maritime">Maritime</option>
<option @if(old('activity_field')=='Étude de marché') selected @endif value="Étude de marché">Étude de marché</option>
<option @if(old('activity_field')=='Marketing/Publicité/Ventes') selected @endif value="Marketing/Publicité/Ventes">Marketing/Publicité/Ventes</option>
<option @if(old('activity_field')=='Génie Mécanique ou Industriel') selected @endif value="Génie Mécanique ou Industriel">Génie Mécanique ou Industriel</option>
<option @if(old('activity_field')=='Production multimédia') selected @endif value="Production multimédia">Production multimédia</option>
<option @if(old('activity_field')=='Équipement médical') selected @endif value="Équipement médical">Équipement médical</option>
<option @if(old('activity_field')=='Pratique Médicale') selected @endif value="Pratique Médicale">Pratique Médicale</option>
<option @if(old('activity_field')=='Soins de santé mentale') selected @endif value="Soins de santé mentale">Soins de santé mentale</option>
<option @if(old('activity_field')=='Industrie militaire') selected @endif value="Industrie militaire">Industrie militaire</option>
<option @if(old('activity_field')=='Mines/Métaux') selected @endif value="Mines/Métaux">Mines/Métaux</option>
<option @if(old('activity_field')=='Images animées/Film') selected @endif value="Images animées/Film">Images animées/Film</option>
<option @if(old('activity_field')=='Musées/Institutions') selected @endif value="Musées/Institutions">Musées/Institutions</option>
<option @if(old('activity_field')=='Musique') selected @endif value="Musique">Musique</option>
<option @if(old('activity_field')=='Nanotechnologie') selected @endif value="Nanotechnologie">Nanotechnologie</option>
<option @if(old('activity_field')=='À but non lucratif/Bénévolat') selected @endif value="Journaux/Journalisme">Journaux/Journalisme</option>
<option @if(old('activity_field')=='Comptabilité') selected @endif value="À but non lucratif/Bénévolat">À but non lucratif/Bénévolat</option>
<option @if(old('activity_field')=='Pétrole/Énergie/Solaire/Greentech') selected @endif value="Pétrole/Énergie/Solaire/Greentech">Pétrole/Énergie/Solaire/Greentech</option>
<option @if(old('activity_field')=='Publication en ligne') selected @endif value="Publication en ligne">Publication en ligne</option>
<option @if(old('activity_field')=='Autre industrie') selected @endif value="Autre industrie">Autre industrie</option>
<option @if(old('activity_field')=='Outsourcing/Offshoring') selected @endif value="Outsourcing/Offshoring">Externalisation/Offshoring</option>
<option @if(old('activity_field')=='Colis/Livraison Fret') selected @endif value="Colis/Livraison Fret">Livraison Colis/Fret</option>
<option @if(old('activity_field')=='Emballage/Conteneurs') selected @endif value="Emballage/Conteneurs">Emballage/Conteneurs</option>
<option @if(old('activity_field')=='Papier/Produits forestiers') selected @endif value="Papier/Produits forestiers">Papier/Produits forestiers</option>
<option @if(old('activity_field')=='Arts du spectacle') selected @endif value="Arts du spectacle">Arts du spectacle</option>
<option @if(old('activity_field')=='Pharmaceuticals') selected @endif value="Pharmaceuticals">Pharmaceuticals</option>
<option @if(old('activity_field')=='Philanthropie') selected @endif value="Philanthropie">Philanthropie</option>
<option @if(old('activity_field')=='Photographie') selected @endif value="Photographie">Photographie</option>
<option @if(old('activity_field')=='Plastiques') selected @endif value="Plastiques">Plastiques</option>
<option @if(old('activity_field')=='"Organisation politique') selected @endif value="Organisation politique">Organisation politique</option>
<option @if(old('activity_field')=='Enseignement primaire/secondaire') selected @endif value="Enseignement primaire/secondaire">Enseignement primaire/secondaire</option>
<option @if(old('activity_field')=='Impression') selected @endif value="Impression">Impression</option>
<option @if(old('activity_field')=='Formation professionnelle') selected @endif value="Formation professionnelle">Formation professionnelle</option>
<option @if(old('activity_field')=='Développement du programme') selected @endif value="Développement du programme">Développement du programme</option>
<option @if(old('activity_field')=='Relations publiques/RP') selected @endif value="Relations publiques/RP">Relations publiques/RP</option>
<option @if(old('activity_field')=='Sécurité publique') selected @endif value="Sécurité publique">Sécurité publique</option>
<option @if(old('activity_field')=='Industrie de l\'édition') selected @endif value="Industrie de l'édition">Industrie de l'édition</option>
<option @if(old('activity_field')=='Fabrication ferroviaire') selected @endif value="Fabrication ferroviaire">Fabrication ferroviaire</option>
<option @if(old('activity_field')=='Élevage') selected @endif value="Élevage">Élevage</option>
<option @if(old('activity_field')=='Immobilier/Hypothèque') selected @endif value="Immobilier/Hypothèque">Immobilier/Hypothèque</option>
<option @if(old('activity_field')=='Installations/Services de loisirs') selected @endif value="Installations/Services de loisirs">Installations/Services de loisirs</option>
<option @if(old('activity_field')=='Institutions religieuses') selected @endif value="Institutions religieuses">Institutions religieuses</option>
<option @if(old('activity_field')=='Renouvelables/Environnement') selected @endif value="Renouvelables/Environnement">Renouvelables/Environnement</option>
<option @if(old('activity_field')=='Industrie de la recherche') selected @endif value="Industrie de la recherche">Industrie de la recherche</option>
<option @if(old('activity_field')=='Restaurants') selected @endif value="Restaurants">Restaurants</option>
<option @if(old('activity_field')=='Industrie du commerce de détail') selected @endif value="Industrie du commerce de détail">Industrie du commerce de détail</option>
<option @if(old('activity_field')=='Sécurité/Enquêtes') selected @endif value="Sécurité/Enquêtes">Sécurité/Enquêtes</option>
<option @if(old('activity_field')=='Construction navale') selected @endif value="Semiconducteurs">Semi-conducteurs</option>
<option @if(old('activity_field')=='Comptabilité') selected @endif value="Construction navale">Construction navale</option>
<option @if(old('activity_field')=='Sports') selected @endif value="Articles de sport">Articles de sport</option>
<option @if(old('activity_field')=='Comptabilité') selected @endif value="Sports">Sports</option>
<option @if(old('activity_field')=='Dotation/Recrutement') selected @endif value="Dotation/Recrutement">Dotation/Recrutement</option>
<option @if(old('activity_field')=='Supermarchés') selected @endif value="Supermarchés">Supermarchés</option>
<option @if(old('activity_field')=='Télécommunications') selected @endif value="Télécommunications">Télécommunications</option>
<option @if(old('activity_field')=='Textile') selected @endif value="Textile">Textile</option>
<option @if(old('activity_field')=='Think Tanks') selected @endif value="Think Tanks">Think Tanks</option>
<option @if(old('activity_field')=='Tabac') selected @endif value="Tabac">Tabac</option>
<option @if(old('activity_field')=='Traduction/Localisation') selected @endif value="Traduction/Localisation">Traduction/Localisation</option>
<option @if(old('activity_field')=='Transport') selected @endif value="Transport">Transport</option>
<option @if(old('activity_field')=='Utilitaires') selected @endif value="Utilitaires">Utilitaires</option>
<option @if(old('activity_field')=='Capital-risque/VC') selected @endif value="Capital-risque/VC">Capital-risque/VC</option>
<option @if(old('activity_field')=='Vétérinaire') selected @endif value="Vétérinaire">Vétérinaire</option>
<option @if(old('activity_field')=='Entreposage') selected @endif value="Entreposage">Entreposage</option>
<option @if(old('activity_field')=='Vente en gros') selected @endif value="Vente en gros">Vente en gros</option>
<option @if(old('activity_field')=='Vins/Spiritueux') selected @endif value="Vins/Spiritueux">Vin/Spiritueux</option>
<option @if(old('activity_field')=='Sans fil') selected @endif value="Sans fil">Sans fil</option>
<option @if(old('activity_field')=='Écriture/Édition') selected @endif value="Écriture/Édition">Écriture/Édition</option>
                                            </select>
                                        </div>
                                        <div class="elementor-field-type-radio elementor-field-group">
                                            <label style="margin-bottom: 14px;" for="form-field-field_ac9d2e3" class="elementor-field-label">Combien d'employé avez vous ?</label>
                                            <div>
                                                <div class="elementor-field-subgroup  elementor-subgroup-inline"
                                                     style="margin-top:5px;">
                                                    <span class="elementor-field-option">
                                                        <input type="radio" @if(old('company_size')=='1to10') checked  @endif value="1to10" id="1to10" name="company_size"
                                                               required>
                                                        <label id="l1to10" for="1to10">1-
                                                            10</label>
                                                    </span>
                                                    <span class="elementor-field-option">
                                                        <input @if(old('company_size')=='20to30') checked @endif type="radio" value="20to30" id="20to30"
                                                               name="company_size" required>
                                                        <label id="l20to30" for="20to30">20 -
                                                            30</label>
                                                    </span>
                                                    <span class="elementor-field-option">
                                                        <input  @if(old('company_size')=='50plus') checked @endif type="radio" value="50plus" id="50plus"
                                                               name="company_size" required>
                                                        <label id="l50plus" for="50plus">50 +</label>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </span>
                                <span id="step2" style="display: none">
                                        <div
                                                class="elementor-field-type-html elementor-field-group elementor-column elementor-field-group-field_283dc04 elementor-col-100">
                                            <h3>Créer votre compte</h3>
                                        </div>
                                        <div
                                                class="elementor-field-type-html elementor-field-group elementor-column elementor-field-group-field_2ca8fb7 elementor-col-100">
                                            <p>Profitez dès maintenant de votre période d’essai gratuite de 15
                                                jours
                                            </p>
                                        </div>
                                        <div
                                                class="elementor-field-type-text elementor-field-group elementor-column  elementor-col-100 elementor-field-required">
                                            <label for="name">Entrez le nom de l'administrateur ici</label>
                                            <input type="text" name="name" value="{{ old('name') }}" id="name" placeholder="Entrez le nom de l'administrateur ici"
                                                   class="form-control" required autofocus>
                                        </div>
                                        @if (module_enabled('Subdomain'))
                                        <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="subdomain"
                                                           name="sub_domain" id="sub_domain">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"
                                                              id="basic-addon2">.{{ get_domain() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                    @endif
                                        <div
                                                class="elementor-field-type-text elementor-field-group elementor-column  elementor-col-100 elementor-field-required">
                                            <label for="email">Email de l'administrateur</label>
                                            <input type="email" name="email" id="email"
                                                   placeholder="Email de l'administrateur" class="form-control" value="{{old('email')}}"
                                                   required>
                                        </div>
                                        <div
                                                class="elementor-field-type-text elementor-field-group elementor-column  elementor-col-100 elementor-field-required">
                                            <label for="password">Mot de passe</label>
                                            <input  minlength="8" type="password" class="form-control " id="password" name="password"
                                                   placeholder="Entrez votre mot de passe ici" required>
                                        </div>
                                        <div
                                                class="elementor-field-type-text elementor-field-group elementor-column  elementor-col-100 elementor-field-required">
                                            <label
                                                    for="password_confirmation">Confirmer mot de passe</label>
                                            <input minlength="8" type="password" class="form-control" id="password_confirmation"
                                                   name="password_confirmation"
                                                   placeholder="Confirmez votre mot de passe" required>
                                        </div>
                                        <div
                                                class="elementor-field-type-acceptance elementor-field-group elementor-column elementor-field-group-field_9b7d282 elementor-col-100 elementor-field-required">
                                            <div class="elementor-field-subgroup">
                                                <span class="elementor-field-option">
                                                    <input type="checkbox" name="terms" id="terms"
                                                           class="elementor-field elementor-size-sm  elementor-acceptance-field"
                                                           required>
                                                    <label for="terms">En cochant cette case,
                                                        vous
                                                        déclarez avoir lu nos <a href="https://visioproact.com/terms">Conditions
                                                            Générales</a>
                                                        et <a href="#">Ventes et
                                                            d’Utilisations</a></label></span>
                                            </div>
                                        </div>
                                        {{-- <div
                                            class="elementor-field-type-step elementor-field-group elementor-column elementor-field-group-field_337f3dc elementor-col-100">
                                            <div class="e-field-step elementor-hidden" data-label=""
                                                data-previousButton="" data-nextButton="" data-iconUrl=""
                                                data-iconLibrary="fas fa-star"></div>
                                        </div>
                                        <div
                                            class="elementor-field-type-html elementor-field-group elementor-column elementor-field-group-message elementor-col-100">
                                            <h3 class="mb-3">Inscription terminée</h3>
                                        </div>
                                        <div
                                            class="elementor-field-type-html elementor-field-group elementor-column elementor-field-group-field_d43352d elementor-col-100">
                                            <p class="mb-3">Nous vous avons envoyés un email de confirmation
                                                pour
                                                votre inscription
                                            <p>
                                        </div> --}}
                                    </span>

                                <br>

                                <div
                                        class="elementor-field-group elementor-column elementor-col-100 e-form__buttons">
                                    <button type="button" class="btn btn-warning btn-lg btn-block "
                                            style="color:white;background-color:#6852f5;margin-top: 40px;" id="next">
                                            <span>
                                                <span class=" elementor-button-icon">
                                                </span>
                                                <span class="elementor-button-text">Suivant</span>
                                            </span>
                                    </button>


                                    <button type="button" class="btn btn-default btn-sm btn-block" style="display:none;width: 10%;border-radius: 8px;margin-bottom: 10px;"
                                            id="back">
                                        <i class="fas fa-arrow-left"></i>
{{--                                            <span>--}}
{{--                                                <span class=" elementor-button-icon">--}}
{{--                                                </span>--}}
{{--                                                <span class="elementor-button-text">Arrière</span>--}}
{{--                                            </span>--}}
                                    </button><br>


                                    <button type="submit" class="elementor-button elementor-size-sm"
                                            style="display: none" id="save">
                                            <span>
                                                <span class=" elementor-button-icon">
                                                </span>
                                                <span class="elementor-button-text">Valider</span>
                                            </span>
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            <script>
                                jQuery(document).ready(function ($) {
                                    $("#1to10").click(function (e) {
                                        // alert($(this).val());
                                        $("#l1to10").css('border', '2px solid #8d5eff');
                                        $("#l20to30").css('border', '1px solid #ddd');
                                        $("#l50plus").css('border', '1px solid #ddd');
                                    });
                                    $("#20to30").click(function (e) {
                                        // alert($(this).val());
                                        $("#l20to30").css('border', '2px solid #8d5eff');
                                        $("#l1to10").css('border', '1px solid #ddd');
                                        $("#l50plus").css('border', '1px solid #ddd');
                                    });
                                    $("#50plus").click(function (e) {
                                        // alert($(this).val());
                                        $("#l50plus").css('border', '2px solid #8d5eff');
                                        $("#l1to10").css('border', '1px solid #ddd');
                                        $("#l20to30").css('border', '1px solid #ddd');
                                    });
                                    @if ($errors->has('email'))
                                    $("#next").hide();
                                    $("#step1").hide();
                                    $("#step2").show();
                                    $("#step2").css({
                                        'display': 'block'
                                    });
                                    $("#step2").show();
                                    $("#back").show();
                                    $("#save").show();
                                    document.getElementById("email").setCustomValidity('{{ $errors->first('email') }}');
                                    var applicationForm = document.getElementById("register");
                                    applicationForm.reportValidity();
                                    $('#password').blur(function () {
                                        // alert('test');
                                        removeValidation();
                                    });
                                    function removeValidation(){
                                        document.getElementById("email").setCustomValidity('');
                                    }
                                    @endif

                                    $("#next").click(function (e) {
                                        e.preventDefault();
                                        console.log($('#company_name').val());
                                        if ($('#company_name').val()){
                                            $(this).hide();
                                            $("#step1").hide();
                                            $("#step2").show();
                                            $("#step2").css({
                                                'display': 'block'
                                            });
                                            $("#step2").show();
                                            $("#back").show();
                                            $("#save").show();
                                        }else {
                                            jQuery("form")[0].reportValidity();
                                        }
                                    });
                                    $("#back").click(function (e) {
                                        e.preventDefault();
                                        $(this).hide();
                                        $("#step1").show();
                                        $("#step2").hide();
                                        $("#next").show();
                                        $("#save").hide();
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
</div>
<style>
    .select2-dropdown--below{
        margin-top: -22px;
    }
    .select2-selection__arrow{
        height: 50px !important;
    }
    .elementor-field-type-html p {
        color: #6c757d;
    }
    .elementor-field-option .elementor-acceptance-field + label {
        color: #6c757d !important;
        font-weight: 400;
    }
</style>
<link rel='stylesheet' href="{{ asset('/umar/css/elementor-assets-lib-animations-animations.min.css') }}">
<script src="{{ asset('/umar/js/imagesloaded.min.js') }}" id="imagesloaded-js"></script>
<script src="{{ asset('/umar/js/masonry.min.js') }}" id="masonry-js"></script>
{{--<script src="{{ asset('/umar/js/jquery.nice-select.min.js') }}" id="nice-select-js"></script>--}}
<script src="{{ asset('/umar/js/jquery.meanmenu.min.js') }}" id="meanmenu-js-js"></script>
<script src="{{ asset('/umar/js/select2.min.js') }}" id="select2-js"></script>
<script src="{{ asset('/umar/js/shadepro-main.js') }}" id="shadepro-main-js"></script>
<script src="{{ asset('/umar/js/wp-embed.min.js') }}" id="wp-embed-js"></script>
<script src="{{ asset('/umar/js/webpack.runtime.min.js') }}" id="elementor-webpack-runtime-js"></script>
<script src="{{ asset('/umar/js/frontend-modules.min.js') }}" id="elementor-frontend-modules-js"></script>
<script src="{{ asset('/umar/js/jquery.sticky.min.js') }}" id="elementor-sticky-js"></script>

<script src="{{ asset('/umar/js/frontend.min.js') }}" id="elementor-pro-frontend-js"></script>
<script src="{{ asset('/umar/js/waypoints.min.js') }}" id="elementor-waypoints-js"></script>
<script src="{{ asset('/umar/js/core.min.js') }}" id="jquery-ui-core-js"></script>
<script src="{{ asset('/umar/js/swiper.min.js') }}" id="swiper-js"></script>
<script src="{{ asset('/umar/js/share-link.min.js') }}" id="share-link-js"></script>
<script src="{{ asset('/umar/js/dialog.min.js') }}" id="elementor-dialog-js"></script>

<script src="{{ asset('/umar/js/frontend.min.js') }}" id="elementor-frontend-js"></script>
<script src="{{ asset('/umar/js/preloaded-modules.min.js') }}" id="preloaded-modules-js"></script>

<script>
    jQuery(document).ready(function () {
        jQuery('#activity_field').select2();
    });
</script>
</body>

</html>
