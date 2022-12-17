<?php

$dsn = getenv('SENTRY_DSN');
$urlParts = parse_url($dsn);

$baseUrl = 'http://localhost:3000'; // @see https://docs.sentry.io/product/relay/ for localhost:3000
# $baseUrl = "{$urlParts['scheme']}://{$urlParts['host']}";
$endpoint = "{$baseUrl}/api{$urlParts['path']}/store/";

$headers = [
    'Content-Type: application/json',
    "X-Sentry-Auth: Sentry sentry_version=7,sentry_client=watashidakenoclient/1.0,sentry_key={$urlParts['user']}",
];

// @see https://github.com/getsentry/sentry/blob/master/src/sentry/data/samples/php.json
$data = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'data/php.json');
// $data = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'data/simple-sample.json');

$ch = curl_init();


curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HEADER, 1);

$result = curl_exec($ch);
$info = curl_getinfo($ch);
$error = curl_error($ch);

xdebug_break();
curl_close($ch);