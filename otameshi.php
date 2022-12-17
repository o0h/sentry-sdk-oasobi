<?php

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

\Sentry\init();

try {
    $this->functionFailsForSure();
} catch (\Throwable $exception) {
    \Sentry\captureException($exception);
}

// OR

\Sentry\captureLastError();