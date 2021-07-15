<?php

declare(strict_types=1);

namespace Unit\Request;

use ArchTools\Bundle\ExtensiveAutomationBundle\Request\InformationSourceMerger;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class InformationSourceMergerTest extends TestCase
{
    public function testWithoutDataInUrl()
    {
        $body = [];
        $routeParams = [];

        $rq =$this->createRequestMock($body, $routeParams);
        $received = InformationSourceMerger::buildFromRequest($rq);

        $expected = [];

        self::assertSame($expected, $received);
    }

    public function createRequestMock(array $body, array $routeParams): Request
    {
        $rte = ['_route_params'=> $routeParams];
        $content = json_encode($body);

        return new Request(attributes: $rte,content: $content);
    }
}