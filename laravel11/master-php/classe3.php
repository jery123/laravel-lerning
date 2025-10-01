<?php 


class BankAccount {
    private float $balance = 0;

    public function getBalance():float {
        return $this->balance;
    }

    public function deposit(float $amount){
        if($amount > 0){
            $this->balance += $amount;
        }
    }

    public function withdraw(float $amount){
        if($amount > 0 && $this->balance >= $amount){
            $this->balance -= $amount;
            return true;
        }
        return false;
    }
}

$account = new BankAccount();
var_dump(
    
    $account->deposit(1000),
    $account->withdraw(600),
    $account->getBalance()
);