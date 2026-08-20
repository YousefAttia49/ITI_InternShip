<?php


// Person

abstract class Person
{
    protected $name;
    protected $address;

    public function __construct($name, $address)
    {
        $this->name = $name;
        $this->address = $address;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function __toString()
    {
        return "Person[name={$this->name},address={$this->address}]";
    }
}




// Student



class Student extends Person
{
    private $program;
    private $year;
    private $fee;

    public function __construct($name, $address, $program, $year, $fee)
    {
        parent::__construct($name, $address);

        $this->program = $program;
        $this->year = $year;
        $this->fee = $fee;
    }

    public function getProgram()
    {
        return $this->program;
    }

    public function setProgram($program)
    {
        $this->program = $program;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year)
    {
        $this->year = $year;
    }

    public function getFee()
    {
        return $this->fee;
    }

    public function setFee($fee)
    {
        $this->fee = $fee;
    }

    public function __toString()
    {
        return "Student[" . parent::__toString() .
            ",program={$this->program},year={$this->year},fee={$this->fee}]";
    }
}




// Staff






class Staff extends Person
{
    private $school;
    private $pay;

    public function __construct($name, $address, $school, $pay)
    {
        parent::__construct($name, $address);

        $this->school = $school;
        $this->pay = $pay;
    }

    public function getSchool()
    {
        return $this->school;
    }

    public function setSchool($school)
    {
        $this->school = $school;
    }

    public function getPay()
    {
        return $this->pay;
    }

    public function setPay($pay)
    {
        $this->pay = $pay;
    }

    public function __toString()
    {
        return "Staff[" . parent::__toString() .
            ",school={$this->school},pay={$this->pay}]";
    }
}


// Shape


abstract class Shape
{
    protected $color = "red";
    protected $filled = true;

    public function __construct($color = "red", $filled = true)
    {
        $this->color = $color;
        $this->filled = $filled;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function isFilled()
    {
        return $this->filled;
    }

    public function setFilled($filled)
    {
        $this->filled = $filled;
    }

    abstract public function getArea();

    abstract public function getPerimeter();

    public function __toString()
    {
        return "Shape[color={$this->color},filled=" . ($this->filled ? "true" : "false") . "]";
    }
}


// Circle



class Circle extends Shape
{
    private $radius = 1.0;

    public function __construct($radius = 1.0, $color = "red", $filled = true)
    {
        parent::__construct($color, $filled);
        $this->radius = $radius;
    }

    public function getRadius()
    {
        return $this->radius;
    }

    public function setRadius($radius)
    {
        $this->radius = $radius;
    }

    public function getArea()
    {
        return pi() * $this->radius * $this->radius;
    }

    public function getPerimeter()
    {
        return 2 * pi() * $this->radius;
    }

    public function __toString()
    {
        return "Circle[" . parent::__toString() . ",radius={$this->radius}]";
    }
}


// Rectangle




class Rectangle extends Shape
{
    protected $width = 1.0;
    protected $length = 1.0;

    public function __construct($width = 1.0, $length = 1.0, $color = "red", $filled = true)
    {
        parent::__construct($color, $filled);
        $this->width = $width;
        $this->length = $length;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function setLength($length)
    {
        $this->length = $length;
    }

    public function getArea()
    {
        return $this->width * $this->length;
    }

    public function getPerimeter()
    {
        return 2 * ($this->width + $this->length);
    }

    public function __toString()
    {
        return "Rectangle[" . parent::__toString() . ",width={$this->width},length={$this->length}]";
    }
}



// Square



class Square extends Rectangle
{
    public function __construct($side = 1.0, $color = "red", $filled = true)
    {
        parent::__construct($side, $side, $color, $filled);
    }

    public function getSide()
    {
        return $this->width;
    }

    public function setSide($side)
    {
        $this->width = $side;
        $this->length = $side;
    }

    public function setWidth($side)
    {
        $this->setSide($side);
    }

    public function setLength($side)
    {
        $this->setSide($side);
    }

    public function __toString()
    {
        return "Square[" . parent::__toString() . "]";
    }
}