<?php

namespace App\Services;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class CrawlerDetector
{
    private const BOT_PATTERNS = [
        'bot',
        'crawl',
        'spider',
        'slurp',
        'mediapartners',
        'wget',
        'curl',
        'python-requests',
        'python-urllib',
        'scrapy',
        'httpclient',
        'go-http-client',
        'java/',
        'libwww',
        'phantomjs',
        'headless',
        'semrush',
        'ahrefs',
        'mj12bot',
        'dotbot',
        'petalbot',
        'bytespider',
        'gptbot',
        'claudebot',
        'anthropic',
        'ccbot',
    ];

    public function __construct(private readonly Agent $agent)
    {
    }

    public function isCrawler(?Request $request = null): bool
    {
        $request ??= request();

        $userAgent = strtolower((string) $request->userAgent());

        if ($userAgent === '') {
            return true;
        }

        if ($this->agent->isRobot()) {
            return true;
        }

        foreach (self::BOT_PATTERNS as $pattern) {
            if (str_contains($userAgent, $pattern)) {
                return true;
            }
        }

        return false;
    }
}
