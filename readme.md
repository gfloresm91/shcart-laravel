# shcart-laravel

* Acceder a la demo desde este link [demo](https://shcartlv.gabrielflores.cl/)

* Carro de compras con [Laravel](https://laravel.com/)

* Metodo de pago web [Laravel cashier](https://laravel.com/docs/5.3/billing) y [stripe](https://stripe.com/)

* Obtencion de USD desde la web de google con [Swap](http://laravel-swap.voutzinos.org/)

* (Se debe cambiar esta parte) Motor de busqueda con [Laravel Scout](https://laravel.com/docs/5.3/scout) y [Algolia](https://www.algolia.com/)

* Inicio de sesion con redes sociales proveido por [Laravel Socialite](https://github.com/laravel/socialite)

* Notificaciones con [toastr](https://github.com/CodeSeven/toastr)

* Layout [e-shopper](http://demo.themeum.com/html/eshopper/)

### **Instrucciones:**

```
composer update

cp .env.example .env

php artisan migrate

php artisan db:seed

(Se debe cambiar) php artisan scout:import "shcart\Product" 
```

**Importante: Este es un proyecto con fines educativos**
