<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <p>Vous avez été invité à un meeting prévu pour le {{$meeting->start_dtae_time}}. </p>
    <p>Pour rejoindre le meeting, cliquez sur ce lien <a href="{{$meeting->join_link}}">{{$meeting->join_link}}</a></p>
  </body>
</html>