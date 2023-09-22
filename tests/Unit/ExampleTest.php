<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Closure;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $resp = $this->requestApi("/v1/articles", function ($currentObj) {
            if ($currentObj->isTokenExpired("2023/09/24")) {
                echo "token is expired" . PHP_EOL;
                $resp = $currentObj->requestTokenAccess();
                if ($resp->getStatusCode() === 200) {
                    echo "response successfully" . PHP_EOL;
                }
            }
        });
        if ($resp->getStatusCode() === 200) {
            echo "response successfully" . PHP_EOL;
        }
        $this->assertTrue(true);
    }

    private function requestApi($uri, Closure $callback = null) {
        if (!is_null($callback)) {
            $callback($this);
        }
        $client = new Client();
        return $client->request('GET', $uri, [
            'verify' => false
        ]);
    }

    private function isTokenExpired($expired) {
        return Carbon::now()->gt(Carbon::parse($expired));
    }

    private function requestTokenAccess() {
        return (new Client())->request('GET', '/v1/token', [
            'verify' => false
        ]);
    }
}
