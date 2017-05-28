<?php

namespace Omnipay\Okpay\Message;


class PurchaseRequest extends AbstractRequest
{

    public function getData()
    {
        $this->validate('account', 'accountName', 'currency', 'amount');

        $data['ok_receiver'] = $this->getAccount();
        $data['ok_item_1_name'] = $this->getAccountName();
        $data['ok_currency'] = $this->getCurrency();
        $data['ok_item_1_price'] = $this->getAmount();
        $data['ok_invoice'] = $this->getTransactionId();

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data, $this->getEndpoint());
    }
}
