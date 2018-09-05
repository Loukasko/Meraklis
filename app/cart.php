<?php

namespace App;
//Create a cart object for a session so we create this Model without using eloquent
class Cart{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart){
        if ($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id){
        //associative Array
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        //if we already have items in the cart
        if ($this->items){
            //check if i have the item i want to add now
            if(array_key_exists($id, $this->items)) {
                //constantly override cause we want to keep each product once and only increase the quantity
                $storedItem = $this->items[$id];
            }
        }
        //create new entry
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
    }
}