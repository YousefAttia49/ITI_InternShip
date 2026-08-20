<?php

class Ball
{
    private $x;
    private $y;
    private $radius;
    private $xDelta;
    private $yDelta;

    public function __construct($x, $y, $radius, $xDelta, $yDelta)
    {
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
        $this->xDelta = $xDelta;
        $this->yDelta = $yDelta;
    }

    public function getX()
    {
        return $this->x;
    }

    public function setX($x)
    {
        $this->x = $x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function setY($y)
    {
        $this->y = $y;
    }

    public function getRadius()
    {
        return $this->radius;
    }

    public function setRadius($radius)
    {
        $this->radius = $radius;
    }

    public function getXDelta()
    {
        return $this->xDelta;
    }

    public function setXDelta($xDelta)
    {
        $this->xDelta = $xDelta;
    }

    public function getYDelta()
    {
        return $this->yDelta;
    }

    public function setYDelta($yDelta)
    {
        $this->yDelta = $yDelta;
    }

    public function move()
    {
        $this->x += $this->xDelta;
        $this->y += $this->yDelta;
    }

    public function reflectHorizontal()
    {
        $this->xDelta = -$this->xDelta;
    }

    public function reflectVertical()
    {
        $this->yDelta = -$this->yDelta;
    }

    public function __toString()
    {
        return "Ball[({$this->x},{$this->y}), speed=({$this->xDelta},{$this->yDelta})]";
    }
}