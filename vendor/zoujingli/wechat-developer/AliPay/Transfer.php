<?php

// +----------------------------------------------------------------------
// | WeChatDeveloper
// +----------------------------------------------------------------------
// | 版权所有 2014~2018 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: http://think.ctolog.com
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/WeChatDeveloper
// +----------------------------------------------------------------------

namespace AliPay;

use WeChat\Contracts\BasicAliPay;

/**
 * 支付宝转账到账户
 * Class Transfer
 * @package AliPay
 */
class Transfer extends BasicAliPay
{

    /**
     * Transfer constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->options->set('method', 'alipay.fund.trans.toaccount.transfer');
    }

    /**
     * 创建数据操作
     * @param array $options
     * @return mixed
     * @throws \WeChat\Exceptions\InvalidResponseException
     */
    public function apply($options)
    {
        return $this->getResult($options);
    }
}