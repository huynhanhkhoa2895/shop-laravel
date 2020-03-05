<?php
namespace App\Factory;
class Cart{
    private $qty;
    private $id;
    public function __construct($id,$qty) {
        $this->id = $id;
        $this->qty = $qty;
    }
    public function getCart($id){
        return [
            "id" => $this->id,
            "qty" => $this->qty
        ];
    }
}