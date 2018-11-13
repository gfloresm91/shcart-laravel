<?php

namespace shcart\Http\Controllers;

use Illuminate\Http\Request;

//Librerias
use Session;
use Redirect;
use Auth;
use Stripe\Stripe;
use Swap;
use Socialite;

//Models
use shcart\Cart;
use shcart\Product;
use shcart\Categories;
use shcart\Order;
use shcart\Brand;

//Requests
use shcart\Http\Requests\OrderRequest;

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
        $user = Auth::user();
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
    //params: Session->cart
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
            'carro' => $cart,
            'products' => $cart->items,
            'totalPrecio' => $cart->totalPrecio 
            ]);
    }

    //Page: Añadir elementos al carro de compras (de uno en uno)
    //route: product.anadiralcarro
    //params: Session->cart
    //Models: shcart\Product
    //        shcart\Cart
    //return: $notificacion -> back
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

    //Page: Añadir elementos al carro de compras (n cantidades definidas por el usuario)
    //route: product.postanadiralcarro
    //params: Session->cart, $request->productos
    //Models: shcart\Product
    //        shcart\Cart
    //return: $notificacion -> back
    public function postanadiralcarro(Request $request)
    {
        if($request->cantidad < 1)
        {
            $notificacion = array(
                'message' => 'La cantidad de productos debe ser mayor a 0', 
                'alert-type' => 'info'
            );
        
            return Redirect::back()->with($notificacion);
        }
        $product = Product::find($request->id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->addmany($product, $request->cantidad, $product->id);
        
        $request->session()->put('cart', $cart);

        $notificacion = array(
            'message' => $product->titulo.' añadido al carro de compras', 
            'alert-type' => 'success'
        );
        
        return Redirect::back()->with($notificacion);
    }

    //Page: Reduce en 1 el contenido del carro
    //route: product.removerunitemcarro
    //params: Session->cart, $id->product_id
    //Models: shcart\Product
    //        shcart\Cart
    //return: $notificacion -> back
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

    //Page: Elimina un producto del carro, independiente cuantas unidades tenga
    //route: product.removeritemcarro
    //params: Session->cart, $id->product_id
    //Models: shcart\Product
    //        shcart\Cart
    //return: $notificacion -> back
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

    //Page: Comprar los articulos dejados en el carro de compras
    //route: product.comprar
    //params: Session->cart
    //Models: shcart\Cart
    //return: $products, $total -> views/shop/carrodecompras
    public function comprar()
    {
        if(!Session::has('cart'))
            return view('shop.carrodecompras');

        $oldCart = Session::get('cart');
        
        if(count($oldCart->items) === 0)
            return Redirect::route('product.carro');
        
        $cart = new Cart($oldCart);
        $total = $cart->totalPrecio;

        $rate = Swap::latest('USD/CLP');
        $totalusd = (number_format(($cart->totalPrecio / $rate->getValue()),2) * 100); 
        
        return view('shop.comprar', [
            'products' => $cart->items,
            'total' => $total,
            'totalusd' => $totalusd
        ]);
    }

    //Page: Comprar los articulos dejados en el carro de compras
    //route: product.postcomprar
    //params: Session->cart, $request->productos
    //Models: shcart\Cart
    //return: $products, $total -> views/shop/carrodecompras
    public function postcomprar(OrderRequest $request)
    {
        if(!Session::has('cart'))
            return Redirect::route('product.carro');

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        try
        {   
            $order = Order::crear($cart, $request);
        }
        catch(Exception $e)
        {
            return Redirect::route('product.comprar')->with('error' , $e->getMessage());
        }

        Session::forget('cart');
        
        $notificacion = array(
            'message' => 'Su compra ha sido realizada, el id de la compra es #' . $order->id, 
            'alert-type' => 'success'
        );

        return Redirect::route('product.index')->with($notificacion);;
    }

    //Page: Buscar segun parametro
    //route: product.search
    //params: $request->Busqueda
    //Models: shcart\Product
    //return: $productos -> views/shop/search
    public function search(Request $request)
    {
        $productos = Product::search($request->search)->paginate();
        return view('shop.search', [
            'productos' => $productos
        ]);
    }
}
