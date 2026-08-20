<?php

class Author
{
    private $name;
    private $email;
    private $gender;

    public function __construct($name, $email, $gender = "")
    {
        $this->name = $name;
        $this->email = $email;
        $this->gender = $gender;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function __toString()
    {
        return "Author[name={$this->name}, email={$this->email}, gender={$this->gender}]";
    }
}


// book




class Book
{
    private $isbn;
    private $name;
    private $author;
    private $price;
    private $qty;

    public function __construct($name, Author $author, $price, $qty = 0, $isbn = "")
    {
        $this->name = $name;
        $this->author = $author;
        $this->price = $price;
        $this->qty = $qty;
        $this->isbn = $isbn;
    }

    public function getIsbn()
    {
        return $this->isbn;
    }

    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor(Author $author)
    {
        $this->author = $author;
    }

    public function getAuthorName()
    {
        return $this->author->getName();
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getQty()
    {
        return $this->qty;
    }

    public function setQty($qty)
    {
        $this->qty = $qty;
    }

    public function __toString()
    {
        return "Book[isbn={$this->isbn}, name={$this->name}, author={$this->author}, price={$this->price}, qty={$this->qty}]";
    }
}



// BookMultipleAuthors



class BookMultipleAuthors
{
    private $name;
    private $authors = [];
    private $price;
    private $qty;

    public function __construct($name, array $authors, $price, $qty = 0)
    {
        $this->name = $name;
        $this->authors = $authors;
        $this->price = $price;
        $this->qty = $qty;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getAuthors()
    {
        return $this->authors;
    }

    public function setAuthors(array $authors)
    {
        $this->authors = $authors;
    }

    public function getAuthorNames()
    {
        $names = [];

        foreach ($this->authors as $author) {
            $names[] = $author->getName();
        }

        return implode(", ", $names);
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getQty()
    {
        return $this->qty;
    }

    public function setQty($qty)
    {
        $this->qty = $qty;
    }

    public function __toString()
    {
        $authors = "";

        foreach ($this->authors as $author) {
            $authors .= $author . " ";
        }

        return "Book[name={$this->name}, authors={$authors}, price={$this->price}, qty={$this->qty}]";
    }
}


// Circle Trait

trait Circle
{
    private $radius = 1.0;
    private $color = "red";

    public function getRadius()
    {
        return $this->radius;
    }

    public function setRadius($radius)
    {
        $this->radius = $radius;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getArea()
    {
        return pi() * $this->radius * $this->radius;
    }

    public function circleToString()
    {
        return "Circle[radius={$this->radius}, color={$this->color}]";
    }
}


// Cylinder

class Cylinder
{
    use Circle;

    private $height = 1.0;

    public function __construct(
        $radius = 1.0,
        $height = 1.0,
        $color = "red"
    ) {
        $this->radius = $radius;
        $this->color = $color;
        $this->height = $height;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getVolume()
    {
        return $this->getArea() * $this->height;
    }

    public function __toString()
    {
        return "Cylinder[" .
            $this->circleToString() .
            ", height={$this->height}]";
    }
}
