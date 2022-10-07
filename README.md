# Ziq&Mu

## Installation

```
git clone -b dev https://github.com/Legacy0013/ziqetmu.git
npm install
composer install
edit .env
php artisan storage:link
php artisan migrate
php artisan db:seed
```

### Configuration

Il faut configurer la base de données et le système d'envoi de mail :

```
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=ziqetmu
DB_USERNAME=root
DB_PASSWORD=root
```

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=824ad51fe50a5X
MAIL_PASSWORD=55762d03f59eX6
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=app@ziqetmu.fr
```

### Crée un utilisateur

```
php artisan tinker
```

```
$user = new App\Models\User();
$user->password = Hash::make('the-password');
$user->email = 'email@example.com';
$user->name = 'My Name';
$user->save();
```

### TODO

Ajouter et faire les contenus des routes :

- /forgot-password
- /contact
√ /mentionsLegales
√ /cgv

HTML & CSS :
√ page 404
