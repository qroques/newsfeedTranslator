# News feed Translator

This application can be use to translate news feeds with Deepl API

## Requirements

### Installed on host

- Docker engine 20.10+
- Docker-compose 1.29+
- Git

### Third party services

- Deepl API key (see: <https://www.deepl.com/docs-api>) ;
- Livesquawk API key ;

## Installation

1. Run command :

    ```shell
    make install
    ```

2. Update `.env` file variable, especially `DEEPL_API_KEY`, `DEEPL_TARGET_LANGUAGE`, `DEEPL_DOMAIN_URL` and `PROVIDER_URL` ;

3. Run command :

    ```shell
    make up
    ```
