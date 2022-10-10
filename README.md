# Coins
*Your total cryptocurrency wealth*

[![Tests](https://github.com/hexhat/coins/actions/workflows/workflow.yml/badge.svg?branch=main)](https://github.com/hexhat/coins/actions/workflows/workflow.yml)

## Acquire the token
Go to the [CoinMarketCap](https://coinmarketcap.com/api), register and get your token. Free plan will be more than enough for this script.

## Setup
You'll need the `intl` extension and the `php` itself; in most cases it will be in your distro repository. Do something like this (Arch Linux example):
```shell
sudo pacman -Sy php php-intl
```
Don't forget to uncomment `extension=intl` in `/etc/php/php.ini`

Create config file:
```ini
; ~/.config/coins/coins.conf
;
; Settings
; ----------------------------
token = your_api_token_from_coinmarketcap
url = https://pro-api.coinmarketcap.com/v2/cryptocurrency/quotes/latest
locale = en_US
currency = USD

; Assets
; ----------------------------
; Format is:
; [id] symbol = your amount of coins
[1]     BTC    = 0.042
[74]    DOGE   = 42.42
[5994]  SHIB   = 420000
[825]   USDT   = 2.99
[8544]  FCL    = 900
[5016]  INNBC  = 4000.00
```

Get & run the project:
```shell
git clone --branch main https://github.com/hexhat/coins.git && cd coins
php bin/coins.php --help
```

Or download the `.phar` file from [release section](https://github.com/hexhat/coins/releases):
```shell
chmod +x coins.phar
./coins.phar
```

## Where to get the cryptocurrency `id` and the `symbol`?
I don't know lol. I was too lazy to read the whole API docs; I'll do it later 😉

As a temporary measure you can acquire all the data with `curl` and manually search id/symbol in the returned json:
```shell
curl -H "X-CMC_PRO_API_KEY: your_api_token_from_coinmarketcap" \
  -H "Accept: application/json" \
  -d "start=1&limit=5000&convert=USD" \
  -G https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest
```
