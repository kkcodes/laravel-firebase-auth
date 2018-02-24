# Firebase Authentication Package for Laravel 

## Description
Firebase Authentication package Baked for Laravel and currently supports Facebook and Google Login. Other methods will be added shortly.

## Dependency

* [FirebaseUI Web](https://github.com/firebase/firebaseui-web)

## Installation

#### Via Composer Require

You may install by running the `composer require` command in your terminal:
```
composer require kkcodes/laravel-firebase-auth
```

**Hope that the default Laravel Auth is already setup. If not, then do setup first.**

Skip the below mentioned step for Laravel 5.5 or greater

**Add Service Provider to your `config/app.php` file**

```
Kkcodes\FirebaseAuth\FirebaseAuthServiceProvider::class
```

**Run `php artisan` command to publish package files into your app**

```
php artisan vendor:publish --provider="Kkcodes\FirebaseAuth\FirebaseAuthServiceProvider"
```

**Now Let's migrate the requried tables**

```
php artisan migrate
```
```
php artisan db:seed --class=FirebaseSigninSourceTableSeeder
```

**From Firebase Console, at the top left corner, there is a Web Setup Button. Click on that and copy and paste the value for respective key in `.env` file**

```
FIREBASE_AUTH_API_KEY=
FIREBASE_AUTH_DOMAIN=
FIREBASE_DB_URL=
FIREBASE_PROJET_ID=
FIREBASE_STORAGE_BUCKET=
FIREBASE_SENDER_ID=

```

**Let's run it. Test is it, with this path after `public/`**
```
auth/login
```