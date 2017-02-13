<?php

namespace shcart;

class Cart
{
    public $items = null;
    public $totalCantidad = 0;
    public $totalPrecio = 0;

    public function __construct($oldCart)
    {
        if($oldCart)
        {
            $this->items = $oldCart->items;
            $this->totalCantidad = $oldCart->totalCantidad;
            $this->totalPrecio = $oldCart->totalPrecio;
        }
    }

    public function add($item, $id)
    {
        $itemAlmacenado = [
            'cantidad' => 0,
            'precio' => $item->precio,
            'item' => $item
        ];

        if($this->items)
        {
            if(array_key_exists($id, $this->items))
                $itemAlmacenado = $this->items[$id];
        }

        $itemAlmacenado['cantidad']++;
        $itemAlmacenado['precio'] = $item->precio * $itemAlmacenado['cantidad'];
        $this->items[$id] = $itemAlmacenado;
        $this->totalCantidad++;
        $this->totalPrecio += $item->precio;
    }

    public function addmany($item, $cantidad, $id)
    {
        $itemAlmacenado = [
            'cantidad' => $cantidad,
            'precio' => $item->precio,
            'item' => $item
        ];

        if($this->items)
        {
            if(array_key_exists($id, $this->items))
                $itemAlmacenado = $this->items[$id];
        }

        $itemAlmacenado['precio'] = $item->precio * $itemAlmacenado['cantidad'];
        $this->items[$id] = $itemAlmacenado;
        $this->totalCantidad += $cantidad;
        $this->totalPrecio += $itemAlmacenado['precio'];
    }

    public function removeaitem($id)
    {
        $this->items[$id]['cantidad']--;
        $this->items[$id]['precio'] -= $this->items[$id]['item']['precio'];
        $this->totalCantidad--;
        $this->totalPrecio -= $this->items[$id]['item']['precio'];

        if($this->items[$id]['cantidad'] <= 0)
            unset($this->items[$id]);
    }
    
    public function removeallitem($id)
    {
        $this->totalCantidad -= $this->items[$id]['cantidad'];
        $this->totalPrecio -= $this->items[$id]['precio'];

        unset($this->items[$id]);

    }
}
