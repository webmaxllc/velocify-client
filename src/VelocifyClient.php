<?php

namespace Webmax\VelocifyClient;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\ClientInterface;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\SerializerBuilder;
use Webmax\VelocifyClient\Model\VelocifyResponse;

/**
 * Velocify API client
 *
 * @author Frank Bardon Jr. <frankbardon@gmail.com>
 * @todo Fully unit test.
 */
class VelocifyClient
{
    /**
     * Guzzle HTTP client
     *
     * @var GuzzleClient
     */
    private $client;

    /**
     * Are we in debug mode?
     *
     * @var boolean
     */
    private $debug;

    /**
     * JMS Serializer
     *
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * JMS Serializer cache directory
     *
     * @var string
     */
    private $serializerCacheDirectory;

    /**
     * Velocify sponsor
     *
     * @var string
     */
    private $sponsor;

    /**
     * Velocify sponsor key
     *
     * @var string
     */
    private $sponsorKey;

    /**
     * Velocify client key
     *
     * @var string
     */
    private $clientKey;

    /**
     * Constructor
     *
     * @param string $apiKey
     * @param string $endpoint
     * @param string $sponsor
     * @param string $sponsorKey
     * @param string $clientKey
     * @param array $config
     */
    public function __construct(
        $apiKey,
        $endpoint,
        $sponsor,
        $sponsorKey,
        $clientKey,
        $config = array(),
        $serializerCacheDirectory = null,
        $debug = false
    ) {
        $config = array_merge_recursive($this->getDefaultConfig($apiKey, $endpoint), $config);

        if ($debug) {
            $config['debug'] = true;
        }

        $this->sponsor = $sponsor;
        $this->sponsorKey = $sponsorKey;
        $this->clientKey = $clientKey;
        $this->debug = $debug;
        $this->serializerCacheDirectory = $serializerCacheDirectory ?: sys_get_temp_dir();
        $this->client = new GuzzleClient($config);
    }

    /**
     * Send a Velocify command packet
     *
     * @param CommandPacket $cp
     * @return VelocifyResponse
     */
    public function sendCommandPacket(CommandPacket $cp)
    {
        $response = $this->client->request('POST', 'job', array(
            'json' => $cp
        ));

        $serializer = $this->getSerializer();

        return $serializer->deserialize($response->getBody(), 'Webmax\VelocifyClient\Model\VelocifyResponse', 'json');
    }

    /**
     * Get base Guzzle client
     *
     * @return ClientInterface
     */
    public function getGuzzleClient()
    {
        return $this->client;
    }

    /**
     * Get or create JMS serializer
     *
     * @return SerializerInterface
     */
    public function getSerializer()
    {
        if (null === $this->serializer) {
            $serializer = SerializerBuilder::create()
                ->addMetadataDir(realpath(__DIR__.'/../metadata'), 'Webmax\\VelocifyClient\\Model')
                ->setDebug($this->debug);

            // Only cache when not debugging.
            if (!$this->debug) {
                $serializer->setCacheDir($this->serializerCacheDirectory);
            }

            $this->serializer = $serializer->build();
        }

        return $this->serializer;
    }

    /**
     * Get default client configuration
     *
     * @param string $apiKey
     * @param string $endpoint
     * @return array
     */
    protected function getDefaultConfig($apiKey, $endpoint)
    {
        return array(
            'base_uri' => sprintf('https://api.vfs.velma.com/%s/', $endpoint),
            'connect_timeout' => 3,
            'timeout' => 5,
            'headers' => array(
                'Content-Type' => 'application/json',
                'x-api-key' => $apiKey,
            )
        );
    }
}
