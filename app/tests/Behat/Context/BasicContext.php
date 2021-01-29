<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use Behat\Behat\Context\Context;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

final class BasicContext implements Context
{
    private array $parameters;
    private array $headers;

    private Response|null $response;

    public function __construct(private KernelInterface $kernel)
    {
        $this->parameters = [];
        $this->headers = [];
        $this->response = null;
    }

    /**
     * @Given the parameter :key with :value as :type
     */
    public function parameterAdd(string $key, string $value, string $type): void
    {
        $value = mb_strtolower($value);
        settype($value, $type);

        $this->parameters[$key] = $value;
    }

    /**
     * @Given the :header with :value
     */
    public function addHeader(string $header, string $value): void
    {
        $this->headers[$header] = $value;
    }

    /**
     * @Given clear :type
     */
    public function clearParameters(string $type): void
    {
        match ($type) {
            'parameters' => $this->parameters = [],
            'headers' => $this->headers = [],
        };
    }

    /**
     * @When sends a :method request to :path
     */
    public function sendsARequestTo(string $method, string $path): void
    {
        $headers = [];
        foreach ($this->headers as $header => $value) {
            $headers['HTTP_' . mb_strtoupper($header)] = $value;
        }

        $request =
            Request::create(
                uri: $path,
                method: $method,
                server: $headers,
                content: json_encode($this->parameters)
            )
        ;

        $this->response = $this->kernel->handle($request);
    }

    /**
     * @Then the response is valid json
     */
    public function iSeeValidJsonBody(): void
    {
        if (null === $this->response) {
            throw new RuntimeException('Response is null');
        }

        if (false === $this->response->getContent()) {
            throw new RuntimeException('Body should be not blank');
        }

        json_decode($this->response->getContent(), true, flags: JSON_THROW_ON_ERROR);
    }

    /**
     * @Then the response status code is :statusCode
     */
    public function theStatusCodeIs(int $statusCode): void
    {
        if (null === $this->response) {
            throw new RuntimeException('Response is null');
        }

        if ($statusCode !== $this->response->getStatusCode()) {
            throw new RuntimeException(
                sprintf('Expected %s, obtained %s', $statusCode, $this->response->getStatusCode())
            );
        }
    }

    /**
     * @Then the response json has :key
     */
    public function responseJsonHasKey(string $key): void
    {
        if (null === $this->response) {
            throw new RuntimeException('Response is null');
        }

        $body = json_decode($this->response->getContent(), true, flags: JSON_THROW_ON_ERROR);

        if (empty($body[$key])) {
            throw new RuntimeException(sprintf('Body must have key: %s', $key));
        }
    }

    /**
     * @Then the response json :key equal to :value
     */
    public function responseJsonHasKeyWithValue(string $key, string $value): void
    {
        if (null === $this->response) {
            throw new RuntimeException('Response is null');
        }

        $body = json_decode($this->response->getContent(), true, flags: JSON_THROW_ON_ERROR);

        if (empty($body[$key])) {
            throw new RuntimeException(sprintf('The response must have key: %s', $key));
        }

        if ($body[$key] !== $value) {
            throw new RuntimeException(sprintf('Expected %s for %s, given: %s', $value, $key, $body[$key]));
        }
    }
}
