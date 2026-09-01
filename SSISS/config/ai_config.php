<?php

/*
|--------------------------------------------------------------------------
| YFF - AI CONFIGURATION
|--------------------------------------------------------------------------
| Secrets are loaded from .env
| NEVER put the API key directly in this file.
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Load .env
|--------------------------------------------------------------------------
*/

$envFile = dirname(__DIR__) . '/.env';

if (file_exists($envFile)) {

    $lines = file(
        $envFile,
        FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
    );

    foreach ($lines as $line) {

        $line = trim($line);

        // Ignore comments
        if ($line === '' || $line[0] === '#') {
            continue;
        }

        // Ignore invalid lines
        if (!str_contains($line, '=')) {
            continue;
        }

        [$name, $value] = explode('=', $line, 2);

        $name = trim($name);
        $value = trim($value);

        // Remove surrounding quotes
        $value = trim($value, "\"'");

        if ($name !== '') {
            $_ENV[$name] = $value;
        }
    }
}


/*
|--------------------------------------------------------------------------
| OpenRouter API Key
|--------------------------------------------------------------------------
*/

$apiKey = $_ENV['OPENROUTER_API_KEY']
    ?? getenv('OPENROUTER_API_KEY')
    ?? '';


/*
|--------------------------------------------------------------------------
| Configuration
|--------------------------------------------------------------------------
*/

return [

    'api_key' => $apiKey,

    'model' => 'openrouter/free',

    'api_url' =>
        'https://openrouter.ai/api/v1/chat/completions',

    'vision_model' => 'openrouter/free'

];