<?php

namespace MrwangTc\Alibabacloud\Alibaba\Billing;

use AlibabaCloud\SDK\BssOpenApi\V20171214\Models\QueryAccountTransactionsRequest;
use AlibabaCloud\Tea\Exception\TeaUnableRetryError;
use MrwangTc\Alibabacloud\Exceptions\HttpException;
use MrwangTc\Alibabacloud\Alibaba\Base;

class AccountTransactions extends Base
{

    protected $PageNum;

    protected $PageSize;

    protected $TransactionNumber;

    protected $RecordID;

    protected $TransactionChannelSN;

    protected $CreateTimeStart;

    protected $CreateTimeEnd;

    protected $data;

    public function pageNum($PageNum)
    {
        $this->PageNum = $PageNum ?? 1;

        return $this;
    }

    public function pageSize($PageSize)
    {
        $this->PageSize = $PageSize ?? 20;

        return $this;
    }

    public function TransactionNumber($TransactionNumber)
    {
        $this->TransactionNumber = $TransactionNumber ?? '';

        return $this;
    }

    public function RecordID($RecordID)
    {
        $this->RecordID = $RecordID ?? '';

        return $this;
    }

    public function TransactionChannelSN($TransactionChannelSN)
    {
        $this->TransactionChannelSN = $TransactionChannelSN ?? '';

        return $this;
    }

    public function CreateTimeStart($CreateTimeStart)
    {
        $this->CreateTimeStart = $CreateTimeStart ?? '';

        return $this;
    }

    public function CreateTimeEnd($CreateTimeEnd)
    {
        $this->CreateTimeEnd = $CreateTimeEnd ?? '';

        return $this;
    }

    /**
     * Notes   : 查询账户流水收支明细
     * @Date   : 2021/5/21 15:21
     * @Author : Mr.wang
     * @return \AlibabaCloud\SDK\BssOpenApi\V20171214\Models\QueryAccountTransactionsResponseBody\data\accountTransactionsList\accountTransactionsList[]
     * @throws \Mrwang\Alibabacloud\Exceptions\HttpException
     */
    public function QueryAccountTransactions()
    {
        $client  = $this->createClient('billing');
        $request = new QueryAccountTransactionsRequest();
        $this->TransactionNumber ? $request->transactionNumber = $this->TransactionNumber : '';
        $this->RecordID ? $request->recordID = $this->RecordID : '';
        $this->TransactionChannelSN ? $request->transactionChannelSN = $this->TransactionChannelSN : '';
        $this->CreateTimeStart ? $request->createTimeStart = $this->CreateTimeStart : '';
        $this->CreateTimeEnd ? $request->createTimeEnd = $this->CreateTimeEnd : '';
        $this->PageNum ? $request->pageNum = $this->PageNum : '';
        $this->PageSize ? $request->pageSize = $this->PageSize : '';

        $response = $client->QueryAccountTransactions($request);
        try {
            $body = $response->body;
            if ($body->code == 'Success') {
                $this->data = $body->data;
            }
        } catch
        (TeaUnableRetryError $e) {
            throw new HttpException($e->getMessage());
        }
    }

    public function get($param)
    {
        switch ($param) {
            case 'total':
                return $this->data->totalCount;
                break;
            case 'content':
                return $this->data->accountTransactionsList->accountTransactionsList;
                break;
            default:
                return '';
        }
    }

}