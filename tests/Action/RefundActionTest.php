<?php

namespace PayumTW\Collect\Tests\Action;

use Mockery as m;
use Payum\Core\Request\Refund;
use PHPUnit\Framework\TestCase;
use Payum\Core\Bridge\Spl\ArrayObject;
use PayumTW\Collect\Action\RefundAction;

class RefundActionTest extends TestCase
{
    protected function tearDown()
    {
        m::close();
    }

    public function testExecute()
    {
        $action = new RefundAction();
        $request = new Refund(new ArrayObject([]));

        $action->setGateway(
            $gateway = m::mock('Payum\Core\GatewayInterface')
        );

        $gateway->shouldReceive('execute')->once()->with(m::type('PayumTW\Collect\Request\Api\RefundTransaction'));

        $action->execute($request);

        $this->assertSame([], (array) $request->getModel());
    }
}
