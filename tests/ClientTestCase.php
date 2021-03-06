<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use Webmax\VelocifyClient\VelocifyClient;

abstract class ClientTestCase extends PHPUnit_Framework_TestCase
{
    public function createClient(array $config = array(), $serializerCacheDirectory = null, $debug = true)
    {
        return new VelocifyClient();
    }

    protected function getData($file)
    {
        return file_get_contents(__DIR__.'/data/'. $file . '.json');
    }

    protected function mockHandler()
    {
        return new MockHandler(func_get_args());
    }

    protected function mockResponse($statusCode, array $headers = array(), $body = null)
    {
        return new Response($statusCode, $headers, $body);
    }

    protected function mockRequestException($message, $statusCode, array $headers = array(), $body = null)
    {
        return new RequestException(
            $message,
            new Request('GET', 'test'),
            new Response($statusCode, $headers, $body)
        );
    }

    protected function mockClientException($message, $statusCode, array $headers = array(), $body = null)
    {
        return new ClientException(
            $message,
            new Request('GET', 'test'),
            new Response($statusCode, $headers, $body)
        );
    }
}
