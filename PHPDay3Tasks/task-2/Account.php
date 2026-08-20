<?php

class Account
{
    private $id;
    private $name;
    private $balance = 0;

    public function __construct($id, $name, $balance = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->balance = $balance;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function credit($amount)
    {
        $this->balance += $amount;
        return $this->balance;
    }

    public function debit($amount)
    {
        if ($amount <= $this->balance) {
            $this->balance -= $amount;
        } else {
            echo "Amount exceeded balance<br>";
        }

        return $this->balance;
    }

    public function transferTo(Account $another, $amount)
    {
        if ($amount <= $this->balance) {
            $this->balance -= $amount;
            $another->credit($amount);
        } else {
            echo "Amount exceeded balance<br>";
        }

        return $this->balance;
    }

    public function __toString()
    {
        return "Account[id={$this->id}, name={$this->name}, balance={$this->balance}]";
    }
}