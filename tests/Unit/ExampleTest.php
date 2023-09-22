<?php

namespace Tests\Unit;

use App\Models\User;
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
        $this->makeRequest("/v1/articles", "GET");
        $this->assertTrue(true);
    }

    private function makeRequest($uri, $method) {
        $resp = $this->requestApi($uri, $method, function ($currentObj) {
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
            return $resp;
        }
        return null;
    }

    private function requestApi($uri, $method = "GET", Closure $callback = null) {
        if (!is_null($callback)) {
            $callback($this);
        }
        return (new Client())->request($method, $uri, [
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
