<?php

namespace MobileCart\DummyPaymentBundle\EventListener\Checkout;

use Symfony\Component\EventDispatcher\Event;

class DummyPaymentJavascript
{
    protected $dummyPaymentService;

    protected $event;

    public function setPaymentMethodService($paymentService)
    {
        $this->dummyPaymentService = $paymentService;
        return $this;
    }

    public function getPaymentMethodService()
    {
        return $this->dummyPaymentService;
    }

    protected function setEvent($event)
    {
        $this->event = $event;
        return $this;
    }

    protected function getEvent()
    {
        return $this->event;
    }

    public function getReturnData()
    {
        return $this->getEvent()->getReturnData()
            ? $this->getEvent()->getReturnData()
            : [];
    }

    public function onCheckoutViewReturn(Event $event)
    {
        $this->setEvent($event);
        $returnData = $this->getReturnData();

        if (!isset($returnData['javascripts'])) {
            $returnData['javascripts'] = [];
        }

        $returnData['javascripts'][] = [
            'js_template' => 'MobileCartDummyPaymentBundle:Checkout:payment_js.html.twig',
            'data' => [
                'code' => $this->getPaymentMethodService()->getCode(),
            ],
        ];

        $event->setReturnData($returnData);
    }
}
