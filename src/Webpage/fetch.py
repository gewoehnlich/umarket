import time
import sys
import undetected_chromedriver as uc
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service as ChromeService

def webpage(url: str) -> str:
    with uc.Chrome(service=ChromeService(ChromeDriverManager().install())) as driver:
        driver.implicitly_wait(60)
        driver.get(url)

        driver.find_element(By.CSS_SELECTOR, "#stickyHeader")

        time.sleep(5)

        html = driver.page_source

    return html

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Для работы скрипта необходимо передать один параметр <ссылка>.")
        print("Например: python [путь-к-файлу]/fetch.py <url>")
        sys.exit(1)

    url = sys.argv[1]
    result = webpage(url)

    print(result)
