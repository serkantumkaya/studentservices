<?php

 class EnumVoltijdDeeltijd
{
    const Voltijd="Voltijd";
    const Deeltijd="Deeltijd";
    const Duaal="Duaal";
     public function getConstants()
     {
         $reflectionClass = new ReflectionClass($this);
         return $reflectionClass->getConstants();
     }
}