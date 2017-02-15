# shcart-laravel

<<<<<<< HEAD
* Carro de compras con [Laravel](https://laravel.com/)
=======
Puede visitar la pagina demo en el siguiente [https://shcartlaravel.gabrielflores.cl/](https://shcartlaravel.gabrielflores.cl/)

Carro de compras con [Laravel](https://laravel.com/)
>>>>>>> b626a9d614aab75e011245ddcabc0673f2c2e2bd

* Metodo de pago web [stripe](https://stripe.com/)

* Obtencion de USD desde la web de google con [Swap](http://laravel-swap.voutzinos.org/)

* Motor de busqueda con [Laravel Scout](https://laravel.com/docs/5.4/scout) y [Algolia](https://www.algolia.com/)

* Notificaciones con [toastr](https://github.com/CodeSeven/toastr)

* Layout [e-shopper](http://demo.themeum.com/html/eshopper/)

### **Instrucciones:**

composer update

cp .env.example .env

php artisan migrate

php artisan db:seed

php artisan scout:import "shcart\Product" 

**Importante: Este es un proyecto con fines educativos**
