<?php

namespace Omnipay\Okpay\Message;

use Omnipay\Tests\TestCase;

class RefundRequestTest extends TestCase
{

    /**
     *
     * @var PurchaseRequest
     *
     */
    private $request;

    protected function setUp()
    {
        $this->request = new RefundRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setAccount('Account');
        $this->request->setAccountName('AccountName');
        $this->request->setCurrency('Currency');
        $this->request->setPayeeAccount('PayeeAccount');
        $this->request->setAmount('10.00');
        $this->request->setSecret('Secret');
        $this->request->setDescription('Description');
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $expectedData = [
            'secret' => 'Secret',
            'walletId' => 'Account',
            'receiver' => 'PayeeAccount',
            'amount' => '10.00',
            'currency' => 'CURRENCY',
            'description' => 'Description',
        ];

        $this->assertEquals($expectedData, $data);
    }


}