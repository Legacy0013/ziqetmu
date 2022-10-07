<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Contact via le site</h2>
    <ul>
      <li><strong>Nom</strong> : {{ $contact['nom'] }}</li>
      <li><strong>Email</strong> : {{ $contact['email'] }}</li>
      <li><strong>Message</strong> : {{ $contact['message'] }}</li>
    </ul>
  </body>
</html>