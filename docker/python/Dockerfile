FROM python:3.13.3

WORKDIR /usr/src/app

RUN apt-get update && \
    apt-get install -y python3-pip && \
    python -m venv .venv && \
    . .venv/bin/activate && \
    pip install --upgrade pip setuptools && \
    pip install curl_cffi undetected-chromedriver webdriver-manager

CMD [ "tail", "-f", "/dev/null" ]
