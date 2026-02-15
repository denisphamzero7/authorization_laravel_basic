<?php
// đăng kí các service provider
return [
    App\Providers\AppServiceProvider::class,
    Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
];
