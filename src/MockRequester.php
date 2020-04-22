<?php


namespace ByJG\ApiTools;

use ByJG\Util\CurlException;
use ByJG\Util\HttpClient;
use ByJG\Util\MockClient;
use ByJG\Util\Psr7\MessageException;
use ByJG\Util\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class MockRequester extends AbstractRequester
{
    /** @var MockClient */
    private $httpClient;

    /**
     * MockAbstractRequest constructor.
     * @param Response $expectedResponse
     */
    public function __construct(Response $expectedResponse)
    {
        $this->httpClient = new MockClient($expectedResponse);
    }

    /**
     * @param RequestInterface $request
     * @return Response|ResponseInterface
     * @throws CurlException
     * @throws MessageException
     */
    protected function handleRequest(RequestInterface $request)
    {
        $request->withHeader("User-Agent", "ByJG Swagger Test");
        return $this->httpClient->sendRequest($request);
    }
}