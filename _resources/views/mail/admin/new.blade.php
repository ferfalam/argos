<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Vous avez été ajoutez en tant que admin de {{$company}} </h2>
    <p>Vous pourrez vous connecter <a href="{{ route('login') }}">ici</a> avec :</p>
    <ul>
      <li><strong>Login</strong> : {{ $data["email"] }}</li>
      <li><strong>Password</strong> : {{ $data["password"] }}</li>
    </ul>
  </body>
</html>