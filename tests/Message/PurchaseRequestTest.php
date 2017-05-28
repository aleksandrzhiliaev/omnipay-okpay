<?php

namespace Omnipay\Okpay\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{

    /**
     *
     * @var PurchaseRequest
     *
     */
    private $request;

    protected function setUp()
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setAccount('Account');
        $this->request->setAccountName('AccountName');
        $this->request->setCurrency('Currency');
        $this->request->setPayeeAccount('PayeeAccount');
        $this->request->setAmount('10.00');
        $this->request->setReturnUrl('ReturnUrl');
        $this->request->setCancelUrl('CancelUrl');
        $this->request->setNotifyUrl('NotifyUrl');
        $this->request->setTransactionId(1);
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $expectedData = [
            'ok_receiver' => 'Account',
            'ok_item_1_name' => 'AccountName',
            'ok_currency' => 'CURRENCY',
            'ok_item_1_price' => '10.00',
            'ok_invoice' => 1,
        ];

        $this->assertEquals($expectedData, $data);
    }

    public function testSendSuccess()
    {
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('https://www.okpay.com/process.html', $response->getRedirectUrl());
        $this->assertEquals('POST', $response->getRedirectMethod());
    }


}