<?php

namespace MrwangTc\Alibabacloud\Alibaba;

use MrwangTc\Alibabacloud\Exceptions\InvalidArgumentException;
use AlibabaCloud\SDK\BssOpenApi\V20171214\BssOpenApi;
use Darabonba\OpenApi\Models\Config;

class Base
{

    protected $config   = [];

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

    protected function createClient($key)
    {
        $config           = new Config([
            // 您的AccessKey ID
            "accessKeyId"     => $this->config['accessKeyId'],
            // 您的AccessKey Secret
            "accessKeySecret" => $this->config['accessKeySecret'],
        ]);
        $config->endpoint = $this->endpoint($key);

        return new BssOpenApi($config);
    }

    protected function endpoint($key)
    {
        $endpoint = [
            'billing' => 'business.aliyuncs.com',
        ];

        return $endpoint[$key];
    }

}