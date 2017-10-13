<?php

namespace PagarMe\SdkTest\Transaction\Request;

use PagarMe\Sdk\Customer\Customer;
use PagarMe\Sdk\Transaction\TransactionHandler;

class TransactionHandlerTest extends \PHPUnit_Framework_TestCase
{
    const PATH           = 'transactions/1337';
    const TRANSACTION_ID = 1337;

    /**
     * @test
     */
    public function transactionObjectMustContainCustomerObject()
    {
        $clientMock =  $this->getMockBuilder('PagarMe\Sdk\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $clientMock->method('send')
            ->willReturn(json_decode($this->getTransactionWithCustomerResponse()));

        $transactionHandler = new TransactionHandler($clientMock);
        $transaction = $transactionHandler->get(184220);

        $this->assertInstanceOf(
            '\PagarMe\Sdk\Customer\Customer',
            $transaction->getCustomer()
        );
    }

    private function getTransactionWithCustomerResponse()
    {
        return '{"object":"transaction","status":"processing","refuse_reason":null,"status_reason":"acquirer","acquirer_response_code":null,"authorization_code":null,"soft_descriptor":"testeDeAPI","tid":null,"nsu":null,"date_created":"2015-02-25T21:54:56.000Z","date_updated":"2015-02-25T21:54:56.000Z","amount":310000,"installments":5,"id":184220,"cost":0,"postback_url":"http://requestb.in/pkt7pgpk","payment_method":"credit_card","antifraud_score":null,"boleto_url":null,"boleto_barcode":null,"boleto_expiration_date":null,"referer":"api_key","ip":"189.8.94.42","subscription_id":null,"phone":null,"address":null,"customer":{ "object": "customer", "id": 342240, "external_id": null, "type": null, "country": null, "document_number": "14936886009", "document_type": "cpf", "name": "DON DIEGO DE LA VEGA", "email": "dondiegodel@vega.com", "phone_numbers": null, "born_at": null, "birthday": null, "gender": null, "date_created": "2017-10-13T21:28:15.030Z", "documents": [] },"card":{"object":"card","id":"card_ci6l9fx8f0042rt16rtb477gj","date_created":"2015-02-25T21:54:56.000Z","date_updated":"2015-02-25T21:54:56.000Z","brand":"mastercard","holder_name":"Api Customer","first_digits":"548045","last_digits":"3123","fingerprint":"HSiLJan2nqwn","valid":null},"split_rules":[{"object":"split_rule","id":"sr_cixi05w5w04erhx6dllaght6m","recipient_id":"re_cixi05vxt04ephx6dxm1y0esy","charge_processing_fee":true,"charge_remainder":false,"liable":true,"percentage":49,"amount":null,"date_created":"2017-01-03T21:03:56.948Z","date_updated":"2017-01-03T21:03:56.948Z"},{"object":"split_rule","id":"sr_cixi05w5v04eqhx6d4ala4v4b","recipient_id":"re_cixi05vt4053fmm6etx9e7h9f","charge_processing_fee":true,"charge_remainder":true,"liable":true,"percentage":51,"amount":null,"date_created":"2017-01-03T21:03:56.947Z","date_updated":"2017-01-03T21:03:56.947Z"}],"metadata":{"idProduto":"13933139"}}';
    }
}
