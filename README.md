<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Tecnologias Utilizadas

Docker,

Compose,

Laravel 11,

Php 8.3,

MySql,

Vue 3 (Composition Api),

Inertia,

Tailwind,

Vite,

Axios.


## Como rodar o projeto

Com o docker instalado e o projeto aberto rode:

docker-compose build

docker-compose up -d

docker-compose exec app composer install

docker-compose exec node npm install

docker-compose exec node npm run dev

docker-compose exec app php artisan migrate:fresh --seed

Agora só abrir o Localhost, para abrir o banco localhost:81

User banco: user
Senha banco: root
Senha padrão dos usuários: password

(Não precisa rodar php artisan serve, ao rodar docker-compose up -d já realiza isso)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
