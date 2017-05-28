<?php

namespace Omnipay\Okpay;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase([
            'amount' => '0.1',
            'currency' => 'USD',
            'transactionId' => 123,
            'description' => 'Order: 123',
            'cancelUrl' => 'https://url.com/cancel',
            'returnUrl' => 'https://url.com/return',
            'notifyUrl' => 'https://url.com/notify',
        ]);

        $this->assertInstanceOf('\Omnipay\Okpay\Message\PurchaseRequest', $request);
        $this->assertSame('0.10', $request->getAmount());
    }

    public function testCompletePurchase()
    {
        $request = $this->gateway->completePurchase();

        $this->assertInstanceOf('\Omnipay\Okpay\Message\CompletePurchaseRequest', $request);
    }

    public function testRefund()
    {
        $request = $this->gateway->refund([
            'payeeAccount' => 'OK1234567890',
            'amount' => 0.1,
            'description' => 'Testing nixmoney',
            'currency' => 'USD',
        ]);

        $this->assertInstanceOf('\Omnipay\Okpay\Message\RefundRequest', $request);
        $this->assertSame('OK1234567890', $request->getPayeeAccount());
    }


}