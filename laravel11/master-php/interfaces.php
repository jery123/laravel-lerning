<?php 

interface PaymentProcessor {
    public function processPayment(float | int $amount): bool;
    public function refundPayment(float | int $amount): bool;
}

// abstract class PaymentProcessor {
//     abstract public function processPayment(float | int $amount): bool;
//     abstract public function refundPayment(float | int $amount): bool;
// }

abstract class OnlinePaymentProcessor implements PaymentProcessor{
    public function __construct(
        protected string $apiKey
    ){}

    abstract protected function validateKey(): bool;
    abstract protected function executePayment(float | int $amount): bool;
    abstract protected function executeRefund(float | int $amount): bool;

    public function processPayment(float | int $amount): bool{
        if(!$this->validateKey()){
            throw new Exception("Invalid API Key");
        }

        return $this->executePayment($amount);
    }

    public function refundPayment(float | int $amount): bool{
        if(!$this->validateKey()){
            throw new Exception("Invalid API Key");
        }

        return $this->executeRefund($amount);
    }
}

class StripeProcessor extends OnlinePaymentProcessor {
    protected function validateKey(): bool{
        return strpos($this->apiKey, 'sk_') === 0;
    }

    protected function executePayment(float | int $amount): bool{
        echo "Processing Stripe payment of $amount\n";
        return true;
    }

    protected function executeRefund(float | int $amount): bool{
        echo "Processing Stripe refund of $amount\n";
        return true;
    }
}
class PayPalProcessor extends OnlinePaymentProcessor {
     protected function validateKey(): bool{
        return strlen($this->apiKey) === 32;
    }
    
    protected function executePayment(float | int $amount): bool{
        echo "Processing PayPal payment of $amount\n";
        return true;
    }

    protected function executeRefund(float | int $amount): bool{
        echo "Processing PayPal refund of $amount\n";
        return true;
    }
}


class CashPaymentProcessor implements PaymentProcessor {
    public function processPayment(float | int $amount): bool{
        echo 'Cash payment...';
        return true;
    }

    public function refundPayment(float | int $amount): bool{
        echo 'Cash refund...';

        return true;
    }
}


class OrderProcessor
{
    public function __construct(
        private PaymentProcessor $paymentProcessor
    ){}

    public function processOrder(float | int $amount, string | array $items): void 
    {

        if(is_array($items)){
            $itemsList = implode(',', $items);
        } else {
            $itemsList = $items;
        }

        echo "Processing order for items: $itemsList\n";

        if($this->paymentProcessor->processPayment($amount)){
            echo "Order procecssed successfully\n";
        } else {
            echo "Order processing failed\n";
        }
    }

    public function refundOrder(float | int $amount): void 
    {
        if($this->paymentProcessor->refundPayment($amount)){
            echo "Order refunded successfully\n";
        } else {
            echo "Order refund failed\n";
        }
    }
}



$stripeProcessor = new StripeProcessor("sk_");
$paypalProcessor = new PayPalProcessor("valid_paypal_api_key_32charslong");
$cashProcessor = new CashPaymentProcessor();

$stripeOrder = new OrderProcessor($stripeProcessor);
$paypalOrder = new OrderProcessor($paypalProcessor);
$cashOrder = new OrderProcessor($cashProcessor);


$stripeOrder->processOrder(100.00, "Book");
$paypalOrder->processOrder(150.00, ["Book", "Movie"]);
$cashOrder->processOrder(50.00, ["Apple", "Orange"]);


$stripeOrder->refundOrder(25.00);
$paypalOrder->refundOrder(50.00);
$cashOrder->refundOrder(10.00);
