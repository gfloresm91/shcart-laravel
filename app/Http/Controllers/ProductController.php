<?php

namespace shcart\Http\Controllers;

use Illuminate\Http\Request;

//Librerias
use Session;
use Redirect;
use Stripe\Stripe;
use Stripe\Charge;
use Auth;

//Models
use shcart\Cart;
use shcart\Product;
use shcart\Categories;
use shcart\Order;
use shcart\Brand;

//Requests
use shcart\Http\Requests\OrderRequest;

// Valor USD
use Exchanger\Service\Service;
use Exchanger\Contract\ExchangeRateQuery;
use Exchanger\ExchangeRate;
use Swap\Service\Registry;
use Swap\Builder;
use Swap;

class ProductController extends Controller
{
    //Page: Inicio
    //route: product.index
    //params:
    //Models: shcart\Product
    //        shcart\Categories
    //        shcart\Brand
    //return: $ofertas, $categorias, $marcas, $products -> views/shop/index
    public function index()
    {
        $ofertas = Product::where('oferta',1)->get();
        $categorias = Categories::with('marcas')->get();
        $marcas = Brand::with('productos')->get();
        $products = Product::with('imagenes')->orderBy('id','DESC')->take(6)->get();

        return view('shop.index',[
            'ofertas' => $ofertas,
            'categorias' => $categorias,
            'marcas' => $marcas,
            'products' => $products
            ]);
    }

    //Page: Listado de productos
    //route: product.productos
    //params:
    //Models: shcart\Product
    //        shcart\Categories
    //        shcart\Brand
    //return: $categorias, $marcas, $products -> views/shop/productos
    public function productos()
    {
        $categorias = Categories::with('marcas')->get();
        $marcas = Brand::with('productos')->get();
        $products = Product::orderBy('id','DESC')->paginate(12);

        return view('shop.productos',[
            'categorias' => $categorias,
            'marcas' => $marcas,
            'products' => $products
        ]);
    }

    //Page: Detalle del producto segun id
    //route: product.productodetalle
    //params: $id->producto_id
    //Models: shcart\Product
    //        shcart\Categories
    //        shcart\Brand
    //return: $categorias, $marcas, $producto -> views/shop/productodetalle
    public function productodetalle($id)
    {
        $categorias = Categories::with('marcas')->get();
        $marcas = Brand::with('productos')->get();
        $producto = Product::find($id);
        
        return view('shop.productodetalle',[
            'categorias' => $categorias,
            'marcas' => $marcas,
            'producto' => $producto
        ]);
    }

    //Page: Productos de una marca segun su id
    //route: product.marca
    //params: $id->marca_id
    //Models: shcart\Product
    //        shcart\Categories
    //        shcart\Brand
    //return: $categorias, $marcas, $products, $title -> views/shop/marca
    public function marca($id)
    {
        $categorias = Categories::with('marcas')->get();
        $marcas = Brand::with('productos')->get();
        $products = Brand::find($id)->productos()->orderBy('id','DESC')->paginate(12);
        $title = Brand::select('nombre')->find($id);
        
        return view('shop.marca',[
            'categorias' => $categorias,
            'marcas' => $marcas,
            'products' => $products,
            'title' => $title
        ]);
    }

    //Page: Carro de compras
    //route: product.carro
    //params: 
    //Models: shcart\Product
    //        shcart\Cart
    //return: $products, $totalPrecio -> views/shop/carrodecompras
    public function carro()
    {
        if(!Session::has('cart'))
            return view('shop.carrodecompras', ['products' => null]);
        
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.carrodecompras', [
            'products' => $cart->items,
            'totalPrecio' => $cart->totalPrecio 
            ]);
    }

    public function anadiralcarro(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        
        $request->session()->put('cart', $cart);

        $notificacion = array(
            'message' => $product->titulo.' añadido al carro de compras', 
            'alert-type' => 'success'
        );

        return Redirect::back()->with($notificacion);
        
    }

     public function postanadiralcarro(Request $request)
    {
        $product = Product::find($request->id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->addmany($product, $request->cantidad, $product->id);
        
        $request->session()->put('cart', $cart);

        $notificacion = array(
            'message' => $product->titulo.' añadido al carro de compras', 
            'alert-type' => 'success'
        );
        
        return Redirect::route('product.index')->with($notificacion);
    }

    public function removerunitemcarro($id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeaitem($id);

        Session::put('cart', $cart);

        $notificacion = array(
            'message' => $product->titulo.' ha sido reducido en 1', 
            'alert-type' => 'warning'
        );

        return Redirect::back()->with($notificacion);
    }

    public function removeritemcarro($id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeallitem($id);

        if(count($cart->items) > 0)
        {
            Session::put('cart', $cart);
        }
        else
        {
            Session::forget('cart');
        }

        Session::put('cart', $cart);

        $notificacion = array(
            'message' => $product->titulo.' ha sido eliminado', 
            'alert-type' => 'error'
        );

        return Redirect::back()->with($notificacion);
    }

    public function comprar()
    {
        if(!Session::has('cart'))
        {
            return view('shop.carrodecompras');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrecio;
        
        return view('shop.comprar', [
            'products' => $cart->items,
            'total' => $total
        ]);
    }

    public function postcomprar(Request $request)
    {
        if(!Session::has('cart'))
        {
            return Redirect::route('product.carro');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        Stripe::setApiKey('Colocar API stripe aquí');
        try
        {
            $rate = Swap::latest('USD/CLP');
            $charge = Charge::create(array(
                "amount" => (number_format(($cart->totalPrecio / $rate->getValue()),2) * 100),
                "currency" => "usd",
                "description" => "Example charge",
                "source" => $request->input('stripeToken'),
                ));
            
            $order = Order::create([
                        'user_id' => Auth::user()->id,
                        'carro' => serialize($cart),
                        'nombres' => $request->input('nombres'),
                        'apellidos' => $request->input('apellidos'),
                        'email' => $request->input('email'),
                        'direccion' => $request->input('direccion'),
                        'codigo_postal' => $request->input('codigo_postal'),
                        'telefono' => $request->input('telefono'),
                        'movil' => $request->input('movil'),
                        'comentario' => $request->input('comentario'),
                        'id_pago' => $charge->id
                     ]);
            Auth::user()->orders()->save($order);
        }
        catch(Exception $e)
        {
            return Redirect::route('product.comprar')->with('error' , $e->getMessage());
        }



        Session::forget('cart');
        return Redirect::route('product.index')->with('success' , 'Compra realizada con exito');
    }
}
