<?php

/**
 * @author dongyu
 * @time 2016-12-28
 * @copyright Copyright (c) 2016 Simple-inc Software  inc
 */
class ComposeTest extends PHPUnit_Framework_TestCase
{
    public function testCompose()
    {

        $fn = compose([
            function (Request $request, $next) {
                $request->add(1);
                $response = $next($request);
                $response->add(1);
                return $response;
            },
            function (Request $request, $next) {
                $request->add(2);
                $response = $next($request);
                $response->add(2);
                return $response;
            },
            function (Request $request) {
                $request->add(3);
                $response = new Response();
                $response->add(3);
                return $response;
            },
        ]);

        $request = new Request();
        $response = $fn($request);
        $requestData = $request->getData();
        $responseData = $response->getData();
        $this->assertEquals([1, 2, 3], $requestData);
        $this->assertEquals([3, 2, 1], $responseData);
    }
}


class Base
{
    protected $data = [];

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    public function add($v)
    {
        $this->data[] = $v;
    }

}


class Request extends Base
{
}

class Response extends Base
{
}