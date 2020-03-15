<?php 
namespace App\Factory\SupperFactory;
interface AbstractFactory{
    public function createProductNike(): AbtractProductNike;
    public function createProductAdidas(): AbtractProductAdidas;
}