<?php return array (
  'barryvdh/laravel-cors' => 
  array (
    'providers' => 
    array (
      0 => 'Fruitcake\\Cors\\CorsServiceProvider',
    ),
  ),
  'barryvdh/laravel-debugbar' => 
  array (
    'providers' => 
    array (
      0 => 'Barryvdh\\Debugbar\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'Debugbar' => 'Barryvdh\\Debugbar\\Facade',
    ),
  ),
  'barryvdh/laravel-dompdf' => 
  array (
    'providers' => 
    array (
      0 => 'Barryvdh\\DomPDF\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
    ),
  ),
  'barryvdh/laravel-translation-manager' => 
  array (
    'providers' => 
    array (
      0 => 'Barryvdh\\TranslationManager\\ManagerServiceProvider',
    ),
  ),
  'berkayk/onesignal-laravel' => 
  array (
    'providers' => 
    array (
      0 => 'Berkayk\\OneSignal\\OneSignalServiceProvider',
    ),
    'aliases' => 
    array (
      'OneSignal' => 'Berkayk\\OneSignal\\OneSignalFacade',
    ),
  ),
  'craftsys/msg91-laravel' => 
  array (
    'aliases' => 
    array (
      'Msg91' => 'Craftsys\\Msg91\\Facade\\Msg91',
    ),
    'providers' => 
    array (
      0 => 'Craftsys\\Msg91\\Msg91LaravelServiceProvider',
    ),
  ),
  'craftsys/msg91-laravel-notification-channel' => 
  array (
    'providers' => 
    array (
      0 => 'Craftsys\\Notifications\\Msg91ChannelServiceProvider',
    ),
  ),
  'edujugon/push-notification' => 
  array (
    'providers' => 
    array (
      0 => 'Edujugon\\PushNotification\\Providers\\PushNotificationServiceProvider',
    ),
    'aliases' => 
    array (
      'PushNotification' => 'Edujugon\\PushNotification\\Facades\\PushNotification',
    ),
  ),
  'facade/ignition' => 
  array (
    'providers' => 
    array (
      0 => 'Facade\\Ignition\\IgnitionServiceProvider',
    ),
    'aliases' => 
    array (
      'Flare' => 'Facade\\Ignition\\Facades\\Flare',
    ),
  ),
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'froiden/envato' => 
  array (
    'providers' => 
    array (
      0 => 'Froiden\\Envato\\FroidenEnvatoServiceProvider',
    ),
  ),
  'intervention/image' => 
  array (
    'providers' => 
    array (
      0 => 'Intervention\\Image\\ImageServiceProvider',
    ),
    'aliases' => 
    array (
      'Image' => 'Intervention\\Image\\Facades\\Image',
    ),
  ),
  'laravel-notification-channels/onesignal' => 
  array (
    'providers' => 
    array (
      0 => 'NotificationChannels\\OneSignal\\OneSignalServiceProvider',
    ),
  ),
  'laravel-notification-channels/twilio' => 
  array (
    'providers' => 
    array (
      0 => 'NotificationChannels\\Twilio\\TwilioProvider',
    ),
  ),
  'laravel/cashier' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Cashier\\CashierServiceProvider',
    ),
  ),
  'laravel/nexmo-notification-channel' => 
  array (
    'providers' => 
    array (
      0 => 'Illuminate\\Notifications\\NexmoChannelServiceProvider',
    ),
  ),
  'laravel/slack-notification-channel' => 
  array (
    'providers' => 
    array (
      0 => 'Illuminate\\Notifications\\SlackChannelServiceProvider',
    ),
  ),
  'laravel/socialite' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Socialite\\SocialiteServiceProvider',
    ),
    'aliases' => 
    array (
      'Socialite' => 'Laravel\\Socialite\\Facades\\Socialite',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'laravel/ui' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Ui\\UiServiceProvider',
    ),
  ),
  'laravelcollective/html' => 
  array (
    'providers' => 
    array (
      0 => 'Collective\\Html\\HtmlServiceProvider',
    ),
    'aliases' => 
    array (
      'Form' => 'Collective\\Html\\FormFacade',
      'Html' => 'Collective\\Html\\HtmlFacade',
    ),
  ),
  'maatwebsite/excel' => 
  array (
    'providers' => 
    array (
      0 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
    ),
    'aliases' => 
    array (
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
    ),
  ),
  'macellan/laravel-zip' => 
  array (
    'providers' => 
    array (
      0 => 'Macellan\\Zip\\ZipServiceProvider',
    ),
    'aliases' => 
    array (
      'Zip' => 'Macellan\\Zip\\ZipFacade',
    ),
  ),
  'macsidigital/laravel-api-client' => 
  array (
    'providers' => 
    array (
      0 => 'MacsiDigital\\API\\Providers\\APIServiceProvider',
    ),
    'aliases' => 
    array (
    ),
  ),
  'macsidigital/laravel-oauth2-client' => 
  array (
    'providers' => 
    array (
      0 => 'MacsiDigital\\OAuth2\\Providers\\OAuth2ServiceProvider',
    ),
    'aliases' => 
    array (
    ),
  ),
  'macsidigital/laravel-zoom' => 
  array (
    'providers' => 
    array (
      0 => 'MacsiDigital\\Zoom\\Providers\\ZoomServiceProvider',
    ),
    'aliases' => 
    array (
      'Zoom' => 'MacsiDigital\\Zoom\\Facades\\Zoom',
    ),
  ),
  'mollie/laravel-mollie' => 
  array (
    'providers' => 
    array (
      0 => 'Mollie\\Laravel\\MollieServiceProvider',
    ),
    'aliases' => 
    array (
      'Mollie' => 'Mollie\\Laravel\\Facades\\Mollie',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'nexmo/laravel' => 
  array (
    'providers' => 
    array (
      0 => 'Nexmo\\Laravel\\NexmoServiceProvider',
    ),
    'aliases' => 
    array (
      'Nexmo' => 'Nexmo\\Laravel\\Facade\\Nexmo',
    ),
  ),
  'nunomaduro/collision' => 
  array (
    'providers' => 
    array (
      0 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    ),
  ),
  'nwidart/laravel-modules' => 
  array (
    'providers' => 
    array (
      0 => 'Nwidart\\Modules\\LaravelModulesServiceProvider',
    ),
    'aliases' => 
    array (
      'Module' => 'Nwidart\\Modules\\Facades\\Module',
    ),
  ),
  'pcinaglia/laraupdater' => 
  array (
    'providers' => 
    array (
      0 => 'pcinaglia\\laraupdater\\LaraUpdaterServiceProvider',
    ),
  ),
  'spatie/laravel-cookie-consent' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\CookieConsent\\CookieConsentServiceProvider',
    ),
  ),
  'tanmuhittin/laravel-google-translate' => 
  array (
    'providers' => 
    array (
      0 => 'Tanmuhittin\\LaravelGoogleTranslate\\LaravelGoogleTranslateServiceProvider',
    ),
  ),
  'trebol/entrust' => 
  array (
    'providers' => 
    array (
      0 => 'Trebol\\Entrust\\EntrustServiceProvider',
    ),
    'aliases' => 
    array (
      'Entrust' => 'Trebol\\Entrust\\EntrustFacade',
    ),
  ),
  'tymon/jwt-auth' => 
  array (
    'aliases' => 
    array (
      'JWTAuth' => 'Tymon\\JWTAuth\\Facades\\JWTAuth',
      'JWTFactory' => 'Tymon\\JWTAuth\\Facades\\JWTFactory',
    ),
    'providers' => 
    array (
      0 => 'Tymon\\JWTAuth\\Providers\\LaravelServiceProvider',
    ),
  ),
  'unicodeveloper/laravel-paystack' => 
  array (
    'providers' => 
    array (
      0 => 'Unicodeveloper\\Paystack\\PaystackServiceProvider',
    ),
    'aliases' => 
    array (
      'Paystack' => 'Unicodeveloper\\Paystack\\Facades\\Paystack',
    ),
  ),
  'yajra/laravel-datatables-buttons' => 
  array (
    'providers' => 
    array (
      0 => 'Yajra\\DataTables\\ButtonsServiceProvider',
    ),
  ),
  'yajra/laravel-datatables-html' => 
  array (
    'providers' => 
    array (
      0 => 'Yajra\\DataTables\\HtmlServiceProvider',
    ),
  ),
  'yajra/laravel-datatables-oracle' => 
  array (
    'providers' => 
    array (
      0 => 'Yajra\\DataTables\\DataTablesServiceProvider',
    ),
    'aliases' => 
    array (
      'DataTables' => 'Yajra\\DataTables\\Facades\\DataTables',
    ),
  ),
);