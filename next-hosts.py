#!/home/wtgg/venvs/py36/bin/python

import datetime
import time
from functools import wraps
import requests


def timer(func):
    @wraps(func)  # 修正 docstring
    def wrap(*args, **kwargs):
        st = time.time()
        result = func(*args, **kwargs)
        et = time.time()
        duration = et - st
        print(f'耗时{duration}秒')
        return result

    return wrap


class Rewrite:
    target_file = '/etc/hosts'
    spliter = '=====以下是GitHub Hosts====='

    api = 'https://gitlab.com/ineo6/hosts/-/raw/master/next-hosts'
    headers = {
        # 'accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
        # 'accept-encoding': 'gzip, deflate, br',
        'accept-language': 'zh-CN,zh;q=0.9,en;q=0.8',
        'cache-control': 'no-cache',
        'dnt': '1',
        'pragma': 'no-cache',
        'referer': 'https://ineo6.github.io/hosts/',
        'sec-fetch-mode': 'navigate',
        'sec-fetch-site': 'none',
        'sec-fetch-user': '?1',
        'upgrade-insecure-requests': '1',
        'user-agent': 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36',
    }

    @classmethod
    @timer
    def run(cls):
        r = requests.get(
            url=cls.api,
            headers=cls.headers
        )
        hosts_text = r.text
        origin_text = cls.r()
        cls.deal(origin_text, hosts_text)
        print(f'{cls.target_file}已更新')

    @classmethod
    def r(cls):
        with open(cls.target_file, 'r', encoding='utf-8') as f:
            origin_text = f.read()
            return origin_text

    @classmethod
    def w(cls, text):
        with open(cls.target_file, 'w', encoding='utf-8') as f:
            f.write(text)

    @classmethod
    def deal(cls, origin_text, hosts_text):
        k, d = origin_text.split(cls.spliter)
        flag = f'=====更新时间：{cls.now_time()}====='
        new_text = f'''{k}\n{cls.spliter}\n{flag}\n\n\n{hosts_text}'''
        cls.w(new_text)

    @staticmethod
    def now_time():
        # 返回值是 字符串类型
        now_time = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")  # 当前时刻
        return now_time


if __name__ == '__main__':
    Rewrite.run()
