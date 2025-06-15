# umarket

## Стек
* python: 3.13.3
    * pip: 25.1.1
    * setuptools: 80.9.0
    * curl_cffi: 0.11.3
    * undetected-chromedriver: 3.5.5
    * webdriver-manager: 4.0.2
* php 8.4.8
    * composer: 2.8.9
    * symfony/dom-crawler: ^7.3
    * symfony/css-selector: ^7.3
    * symfony/error-handler: ^7.3
    * symfony/process: ^7.3
    * symfony/validator: ^7.3
* (Опционально)
    * docker: 28.2.2
    * docker-compose: 2.37.1

## Установка
* ### Docker
```
git clone https://github.com/gewoehnlich/umarket.git

sudo [package-manager] install docker
sudo [package-manager] install docker-compose
```

Если удобно, можно либо запустить образ в `Docker` через `Makefile`:
```
make build   -- собрать образ в первый раз
make up      -- запустить готовый образ
make down    -- остановить образ
make delete  -- удалить образ
```

Или можно запускать вручную:
```
docker compose up --build   -- собрать образ в первый раз
docker compose up           -- запустить готовый образ
docker compose down         -- остановить образ
docker compose down -v      -- удалить образ
```

* ### Вручную
**[package-manager] заменить на соответствующий вашему дистрибутиву
Например: [apt, dnf или pacman]**

```
sudo [package-manager] update

git clone https://github.com/gewoehnlich/umarket.git

sudo [package-manager] install python
sudo [package-manager] install pip
python -m venv .venv
source .venv/bin/activate

pip install setuptools
pip install curl_cffi
pip install undetected-chromedriver
pip install webdriver-manager

sudo [package-manager] install php
sudo [package-manager] install composer

composer install
```

### Как пользоваться:
```
php public/index.php https://www.ozon.ru/product/1712766160/
```

### Пример:
```
php public/index.php https://www.ozon.ru/product/567895244/
```

**Ответ:**
```
Array
(
    [success] => 1
    [result] => Array
        (
            [Название] => Чай в пакетиках черный Принцесса Нури Высокогорный, 100 шт
            [Категория] => Array
                (
                    [0] => Продукты питания
                    [1] => Чай, кофе и какао
                    [2] => Чай
                    [3] => В пакетиках и пирамидках
                    [4] => Принцесса Нури
                )

            [Тип] => Чай в пакетиках
            [Страна] => Россия
            [Артикул] => 567895244
            [Страна-изготовитель] => Россия
            [Изображения] => Array
                (
                    [0] => https://ir.ozone.ru/s3/multimedia-o/wc50/6306798828.jpg
                    [1] => https://ir.ozone.ru/s3/multimedia-p/wc50/6306798829.jpg
                    [2] => https://ir.ozone.ru/s3/multimedia-q/wc50/6306798830.jpg
                    [3] => https://ir.ozone.ru/s3/multimedia-o/wc1000/6306798828.jpg
                )

            [Описание] => Крепкий и насыщенный черный чай, который отличается выраженным вкусом, тонким цветочно-сливочным ароматом и ярко-рубиновым настоем. Мелкие чайные листочки, которые используются для приготовления пакетированного чая, очень быстро отдают напитку природную насыщенность и свежесть.Положить в заварочный чайник или чашку по одному пакетику на человека. Залить кипятком и настаивать 2-3 минуты. Качественное заваривание благодаря двойному пакетику.Натуральный чай не содержит красителей, консервантов и ГМО.
            [Характеристики] => Array
                (
                    [Артикул] => 567895244
                    [Тип] => Чай в пакетиках, Чай в пакетиках
                    [Вид чая] => Черный, Черный
                    [Число пакетиков] => 100, 100
                    [Единиц в одном товаре] => 1
                    [Вес товара, г] => 200
                    [Минимальная температура] => 5
                    [Максимальная температура] => 25
                    [Не содержит] => без ГМО, ,, без искусственных красителей, без искусственных красителей, ,, без консервантов, без консервантов
                    [Срок годности в днях] => 1080
                    [Страна-изготовитель] => Россия
                    [Упаковка] => Картонная коробка, Картонная коробка
                    [Особенности напитков, продуктов питания:] => Вегетарианский продукт, ,, Диетический продукт, Диетический продукт, ,, Натуральный продукт
                )
        )
)
```
