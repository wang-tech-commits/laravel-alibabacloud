<?php

namespace MrwangTc\Alibabacloud\Alibaba;

use Mrwang\Alibabacloud\Exceptions\InvalidArgumentException;

class Base
{
    protected $config = [];

    public function __construct()
    {
        $config = config('alibabacloud');

        if (empty($config['accessKeyId'])) {
            throw new InvalidArgumentException('AccessKeyID不存在');
        }
        if (empty($config['accessKeySecret'])) {
            throw new InvalidArgumentException('AccessKeySecret不存在');
        }

        $this->config = $config;
    }

}