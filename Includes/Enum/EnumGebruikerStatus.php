<?php

class EnumGebruikerStatus
{
    const actief = "actief";
    const nonactief = "nonactief";

    public function getConstants()
    {
        $reflectionClass = new ReflectionClass($this);
        return $reflectionClass->getConstants();
    }
}