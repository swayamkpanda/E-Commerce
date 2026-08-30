<?php

/*
|--------------------------------------------------------------------------
| SSISS - AI Configuration
|--------------------------------------------------------------------------
|
| This file contains configuration for the AI features
| of the SSISS website.
|
| AI features:
| - AI Fashion Recommendations
| - Vibe Dress
| - Outfit Generation
| - Personalized Product Suggestions
|
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| AI Provider
|--------------------------------------------------------------------------
|
| We can change this later depending on the API
| we decide to use.
|
*/

define(
    'AI_PROVIDER',
    'none'
);


/*
|--------------------------------------------------------------------------
| AI API Key
|--------------------------------------------------------------------------
|
| Keep this empty until we connect an actual API.
|
| IMPORTANT:
| Never upload a real API key to GitHub.
|
*/

define(
    'AI_API_KEY',
    ''
);


/*
|--------------------------------------------------------------------------
| AI API URL
|--------------------------------------------------------------------------
|
| This will be updated when we choose the
| AI provider.
|
*/

define(
    'AI_API_URL',
    ''
);


/*
|--------------------------------------------------------------------------
| AI Model
|--------------------------------------------------------------------------
|
| The model name will depend on the provider.
|
*/

define(
    'AI_MODEL',
    ''
);


/*
|--------------------------------------------------------------------------
| AI Request Settings
|--------------------------------------------------------------------------
*/

define(
    'AI_TIMEOUT',
    30
);


/*
|--------------------------------------------------------------------------
| Maximum Image Size
|--------------------------------------------------------------------------
|
| User-uploaded fashion photos used by AI.
|
*/

define(
    'AI_MAX_IMAGE_SIZE',
    5 * 1024 * 1024
);


/*
|--------------------------------------------------------------------------
| Supported Image Types
|--------------------------------------------------------------------------
*/

define(
    'AI_ALLOWED_IMAGE_TYPES',
    [
        'image/jpeg',
        'image/png',
        'image/webp'
    ]
);

?>