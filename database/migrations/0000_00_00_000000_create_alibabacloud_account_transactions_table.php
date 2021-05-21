<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlibabacloudAccountTransactionsTable extends Migration
{

    /**
     * Notes   : 获取阿里云账单，本地数据库存一下
     * @Date   : 2021/5/21 11:19
     * @Author : Mr.wang
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('user_certifications', function (Blueprint $table) {
            $table->id();
            $table->enum('transaction_type', ['Payment', 'Withdraw', 'Refund', 'Comsumption', 'Transfer', 'Adjust'])
                  ->comment('交易类型');
            $table->string('billing_cycle')->comment('账期，格式：YYYY-MM');
            $table->string('transaction_number')->comment('交易编号');
            $table->decimal('amount', 10, 5)->comment('金额');
            $table->decimal('transaction_account', 10, 5)->nullable()->comment('对应交易账号，比如支付宝充值账号或转账对端账号');
            $table->timestamp('transactiond_at')->nullable()->comment('交易时间');
            $table->string('transaction_channel_sn')->comment('交易渠道流水号');
            $table->string('remark')->nullable()->comment('交易备注');
            $table->enum('fund_type', ['Cash', 'Deposit', 'RegularBankCreditRefund'])->comment('资金形式');
            $table->enum('transaction_flow', ['Income', 'Expense'])->comment('收支类型');
            $table->string('record_id')->comment('订单号/账单号');
            $table->decimal('balance', 10, 5)->comment('余额');
            $table->enum('transaction_channel', [
                'AccountBalance', 'BankTransfer', 'Alipay', 'AntCreditPay', 'OfflineRemittance',
                'RegularBankCreditRefund', 'CreditCard', 'MyBankCredit', 'HuaxiaBankCInstallment',
            ])->comment('交易渠道');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alibabacloud_account_transactions');
    }

}