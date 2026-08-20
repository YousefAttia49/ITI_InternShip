<?php

class Circle
{
    private $radius = 1.0;
    private $color = "red";

    public function __construct($radius = 1.0, $color = "red")
    {
        $this->radius = $radius;
        $this->color = $color;
    }

    public function getRadius()
    {
        return $this->radius;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setRadius($radius)
    {
        $this->radius = $radius;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getArea()
    {
        return pi() * $this->radius * $this->radius;
    }

    public function __toString()
    {
        return "Circle [Radius={$this->radius}, Color={$this->color}]";
    }
}