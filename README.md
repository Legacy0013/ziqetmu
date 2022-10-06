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
