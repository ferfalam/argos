<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>{{auth()->user()->name}} a modifier vos informations de connexion. </h2>
    <p>Vous pourrez vous connecter <a href="{{ route('login') }}">ici</a> avec :</p>
    <ul>
      <li><strong>Login</strong> : {{ $data["email"] }}</li>
      <li><strong>Password</strong> : {{ $data["password"] }}</li>
    </ul>
  </body>
</html>