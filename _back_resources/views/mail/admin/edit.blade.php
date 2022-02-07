<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Vos Informations de connexion en tant que admin de {{$company}} ont été modifié</h2>
    <p>Connectez vous à nouveau <a href="{{ route('login') }}">ici</a> avec :</p>
    <ul>
      <li><strong>Login</strong> : {{ $data["email"] }}</li>
      <li><strong>Password</strong> : {{ $data["password"] }}</li>
    </ul>
  </body>
</html>