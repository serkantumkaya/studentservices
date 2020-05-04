<?php

class EnumGebruikerStatus
{
    const actief = "actief";
    const nonactief = "nonactief";
    const verwijderd = "verwijderd";
    const onbekend = "onbekend";

    public function getConstants()
    {
        $reflectionClass = new ReflectionClass($this);
        return $reflectionClass->getConstants();
    }
}