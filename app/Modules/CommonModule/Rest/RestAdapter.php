<?php declare(strict_types=1);

namespace DJKT\Backstage\Modules\CommonModule\Rest;


use GuzzleHttp\Client;
use Nette\Utils\Json;
use Psr\Http\Message\ResponseInterface;

class RestAdapter
{
    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {

        $this->client = $client;
    }

    public function get(string $path, $options = [])
    {
        $response = $this->client->get($path, $options);
        return $this->getResponseResult($response);
    }

    public function post(string $path, $body)
    {
        $response = $this->client->post($path, [
            'json' => $body,
        ]);
        return $this->getResponseResult($response);
    }

    private function getResponseResult(ResponseInterface $response)
    {
        $body = $response->getBody()->getContents();

        $contentType = $response->getHeader('Content-Type');
        if ($contentType) {
            $typeParts = explode(';', $contentType[0]);
            $type = trim($typeParts[0]);
            if ($type == 'application/json') {
                return Json::decode($body, Json::FORCE_ARRAY);
            }
        }


        return $body;
    }
}