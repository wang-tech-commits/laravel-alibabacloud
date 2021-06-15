<?php

namespace MrwangTc\Alibabacloud\Alibaba\Billing;

use AlibabaCloud\SDK\BssOpenApi\V20171214\Models\QueryMonthlyBillRequest;
use AlibabaCloud\Tea\Exception\TeaUnableRetryError;
use Carbon\Carbon;
use MrwangTc\Alibabacloud\Exceptions\HttpException;
use MrwangTc\Alibabacloud\Alibaba\Base;

class MonthlyBill extends Base
{

    /**
     * Notes   : 月账单查询
     * @Date   : 2021/5/24 14:56
     * @Author : Mr.wang
     * @param  string  $mounth
     * @return \AlibabaCloud\SDK\BssOpenApi\V20171214\Models\QueryMonthlyBillResponseBody\data
     * @throws \Mrwang\Alibabacloud\Exceptions\HttpException
     */
    public function QueryMonthlyBill($mounth = '')
    {
        $client  = $this->createClient('billing');
        $request = new QueryMonthlyBillRequest();

        $request->billingCycle = empty($mounth) ? Carbon::now()->format('Y-m') : $mounth;

        $response = $client->QueryMonthlyBill($request);
        try {
            $body = $response->body;
            if ($body->code == 'Success') {
                return $body->data;
            }
        } catch
        (TeaUnableRetryError $e) {
            throw new HttpException($e->getMessage());
        }
    }

}