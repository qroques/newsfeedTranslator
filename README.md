# RSS Translator

This application can be use to translate RSS feeds with Deepl API

## Requirements

- Docker engine 20.10+
- Docker-compose 1.29+

## Installation

1. Run command :

```shell
make install
```

2. Update `.env` file variable, especially `DEEPL_API_KEY`, `DEEPL_TARGET_LANGUAGE`, `DEEPL_DOMAIN_URL` and `RSS_FEED_URL` ;

3. Run command :

```shell
make up
```
