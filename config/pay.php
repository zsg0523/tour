<?php

return [
    'alipay' => [
        'app_id'         => '2016101600702358',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlUWaoJEe8Ef3SnKJtkC5sWpB3V9jEbgP7PDcEy3hM3JI+YLd8FbI3CYdQycQ9lxh7c3Q1Puu2JcrZ4VEeswsXsWyL2Kb/0w7TZNxqQFu7BsqQTYfFCgFKbQxrcBrgs51JpOWcq8+v1TRG45mBpdMjFQWNTJm43mVVGksqktxIRPkkeDwbTAkW1hmKSFzK19ZBRY5ICv2g6IhyNoQgXvbnzQTMP2U+NCcf7CQWFtxx3Tj5sjCDFhfXg9LUgjNSH1fc37UPOmTq0iQhdySqg8lSv7Xm+xuyQHuH8hb7AhG6tp7YVu7otJcAJMcLnwX/nBtH767lMuQZnxw78UYHKcvGwIDAQAB',
        'private_key'    => 'MIIEpQIBAAKCAQEAs79LLWmTrTj/JFYdb0zuPWYeU56eHPj1WIoPyKvWMJXhWNR00rtcAZGmGpps4Q/IccMh1q7Yu+OufaIk2I2+6zkFv2Hq4Ur4XDup0pbKpdqwyjp9YdVnWEn0w5CkwmG+wGxDdqOQQHqv7bPtx+cJ5tYXDmb13peeUD3HoIKvubgaxYgKpzIAChnJo0+WxLfxHUrtcAcjANAfEOcWUtan7tEr/f/JkU3FqZxTcnEuhRssJ9tHayJ8ndXhFMdGbAIQsu8mfCfzcPh4HTMbXd7rk5wCbqevnzoUHkn6lO0ADfIjRsq9x7dN8mKT4FohClIjPMq/qZUYHUtT91wnA4QuIwIDAQABAoIBAF37FPmHjBk0BeMfy4AYPzCHJjAebRlE6jMC7MHFZtY8Z3ikjPhp0e9YEfsy5t69+9XPau/ut491uhQiJRW89yfRxrmMHtzw7+55m49qHEafk3QJJOl0RPaapIlkJWEk7jF56cQsPQ4Zl8a3Hwo4OKsjISb8mm1p5PKberbn3a1CPpgzaOQsIfXcIDsP12toBl5rwogGZMdvm1KQ+UMt9OvXsz7JYipAo5hRELwgnj5xhnKffE4E/npl7ZpnTvbvG0Ha3HZUsGMV/C8Fh/SI2LXSCb65Ur0o9AoAjlbnnRYJZU4BFG8C/ReLMbPL5/b64ATgYc2tFUy3b9zgypupBMECgYEA5YdeG14PuPa7kY6Al0Gs4sGTKVjyoqQ5/OxKb5RzdAydlugOHmasr7qJqzsruJvHwMtlzSaMjTC7h+qBlNAvhrVaGVVuNL3GIquGE4lmDr7CkCvrOq64ln5R/vsMsIGZ2AGaP9m4LIXAzzelxjxhbP5Wn0DJK2IqMrZMuctLw9MCgYEAyHorqOmOxRxgm+3mNtjyzpkGCiO2y2qN5QtQIpD4St2junOrhixL9nGwtHWZU6vqkLMurQOu5kV1fnj+ky9jahy8Ogr4RYH5onZPXgeJohMm0aEZ89Kb/R3/1veulYYcSsvuzc77QoRIZ/tWFn+QSMBbEFx+JQxwF/kM3EeRinECgYEApiXnKUhdeTahcCwHSXZw/3PAYx3QBYt7rmodN8fuCwNWz/YKwlbwigQtw5WBgJDDd/vEJUzSUSIFnc1TH7XTsV91aQE+VU9KLa6bz2iWR/YuQM6J6GCxnb6y/DAeb2ZhRstiLPYdK51mhJlzlpv+qjcx3PW4qX7VrP/palSO86ECgYEAt3p4suLu85+BG7SjWdc8gbCzQlxlU851hwbPlJMxavNmgaKTfPzVmPt8SezHIzjYOQ6EzXvtenpfihyagYKBbgBWlJitmI/YNMQq51fmsxrsEDdtVSWP9hyapdeRRO+0vQ/fwySH+Nywl9oDdBvTpYHG1jaQjL/RZ19cUc5+eUECgYEAyjtlkPVYRoreo1emRwumcJESUVwJsP8ZC5qrVtESafgbuP6ZYW5k7n747y3LDAVts7BFz604ziqc5R07z5JIagrpfNoudhT3BsRdujLZePIqEauvqUGdHbtGYGgUUJbJgV5BUYwkDyxFeJ4YYAPdpZYnXRPgKAbnjpBBg9I5iN4=',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => '',
        'mch_id'      => '',
        'key'         => '',
        'cert_client' => '',
        'cert_key'    => '',
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];
