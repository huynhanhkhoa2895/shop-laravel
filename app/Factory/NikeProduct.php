<?php
namespace App\Factory;
use App\Factory\Abtract\AbstractProductNike as ProductInterface; 
class NikeProductTShirt extends AbstractProductNike {
    function usefulFunctionNike(){
        return "Nike Product usefulFunctionNike";
    }
}