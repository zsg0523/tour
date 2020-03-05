<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Exceptions\InvalidRequestException;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Events\OrderPaid;

class PaymentController extends Controller
{
    /** [payByAlipay 支付宝支付] */
    public function payByAlipay(Order $order, Request $request)
    {
    	// 判断订单是否属于当前用户
    	$this->authorize('own', $order);
    	// 订单已支付或已关闭
    	if ($order->paid_at || $order->closed) {
            throw new InvalidRequestException('订单状态不正确');
        }
    	// 调用支付宝网关支付
    	return app('alipay')->web([
            'out_trade_no' => $order->no, // 订单编号，需保证在商户端不重复
            'total_amount' => $order->total_amount, // 订单金额，单位元，支持小数点后两位
            'subject'      => '支付 Wenno Shop 的订单：'.$order->no, // 订单标题
        ]);
    }

    // 前端回调页面
    public function alipayReturn()
    {
        try {
            app('alipay')->verify();
        } catch (\Exception $e) {
            return view('pages.error', ['msg' => '数据不正确']);
        }

        return view('pages.success', ['msg' => '付款成功']);
    }

    // 服务器端回调
    public function alipayNotify()
    {
        // 校验输入参数
        $data  = app('alipay')->verify();
        // 如果订单状态不是成功或者结束，则不走后续的逻辑
        // 所有交易状态：https://docs.open.alipay.com/59/103672
        if(!in_array($data->trade_status, ['TRADE_SUCCESS', 'TRADE_FINISHED'])) {
            return app('alipay')->success();
        }
        // $data->out_trade_no 拿到订单流水号，并在数据库中查询
        $order = Order::where('no', $data->out_trade_no)->first();
        // 正常来说不太可能出现支付了一笔不存在的订单，这个判断只是加强系统健壮性。
        if (!$order) {
            return 'fail';
        }
        // 如果这笔订单的状态已经是已支付
        if ($order->paid_at) {
            // 返回数据给支付宝
            return app('alipay')->success();
        }

        $order->update([
            'paid_at'        => Carbon::now(), // 支付时间
            'payment_method' => 'alipay', // 支付方式
            'payment_no'     => $data->trade_no, // 支付宝订单号
        ]);

        // 订单支付成功后触发事件
        $this->afterPaid($order);

        return app('alipay')->success();
    }

    /**
     * [payByPayPalCheckout paypal支付]
     * @param  Order   $order   [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function payByPayPalCheckout(Order $order, Request $request)
    {
        // 判断订单状态
        if ($order->paid_at || $order->closed) {
            throw new InvalidRequestException('订单状态不正确');
        }
        // 得到支付的链接
        $data =
        [
            // 'address'      =>'https://www.sandbox.paypal.com/cgi-bin/webscr',//测试沙盒,该环境不可用CNY
            'address'      =>'https://www.paypal.com/cgi-bin/webscr',//正式地址
            'cmd'          =>'_xclick',
            // 'business'     =>'paypal@ifn-asia.org',//测试商户账号
            'business'     =>'ac.dept@shtoys.com.hk',
            'item_name'    =>$order->remark ?? '支付 Wenno Shop 的订单：'.$order->no, // 订单描述
            'item_number'  =>$order->no,  // 商品编号
            'invoice'      =>$order->no, // 订单编号
            'currency_code'=>'HKD', // 货币种类
            'no_shipping'  =>'1',
            'amount'       =>$order->total_amount,   // 商品金额，总价
            'notify_url'   =>route('payment.paypal.notify'), // 后端回调地址
            'cancel_return'=>'', // 客户取消交易返回地址
            'return'       =>route('payment.paypal.return'), // 客户交易返回地址
        ];

        // 拼接组装url
        $url  = $data['address'].'?cmd='.$data['cmd'].'&business='.$data['business'].'&item_name='.$data['item_name'].'&item_number='.$data['item_number'].'&invoice='.$data['invoice'].'&currency_code='.$data['currency_code'].'&no_shipping='.$data['no_shipping'].'&amount='.$data['amount'].'&notify_url='.$data['notify_url'].'&cancel_return='.$data['cancel_return'].'&return='.$data['return'];
        
        // 支付链接
        return redirect($url);
    }

    // Paypal前端回调
    public function payPalReturn()
    {
        return view('pages.success', ['msg' => '付款成功']);
    }

    // Paypal后端回调
    public function payPalNotify()
    {
        $jsonStr = file_get_contents("php://input");
        $data    = explode('&', $jsonStr);
        
        \Log::debug('Paypal notify', $data);
        //签名数据会被转码，需解码urldecode
        foreach ($data as $key => $value) {
            $temp    = explode('=', $value);
            $map[$temp[0]]=urldecode(trim($temp[1]));
        }
        
        $req  = 'cmd=_notify-validate';

        foreach ($map as $key => $value) {        
           if(get_magic_quotes_gpc() == 1){
                $value =urlencode(stripslashes($value)); 
           }else{
                $value = urlencode($value);
           }
           $req.= "&$key=$value";
        }

        $order = Order::where('no', $map['invoice'])->first();
        // 正常来说不太可能出现支付了一笔不存在的订单，这个判断只是加强系统健壮性。
        if (!$order) {
            return 'fail';
        }

        $order->update([
            'paid_at'        => Carbon::now(), // 支付时间
            'payment_method' => 'paypal', // 支付方式
            'payment_no'     => $map['payer_id'], // 支付宝订单号
        ]);

        // 订单支付成功后触发事件
        $this->afterPaid($order);
        

        // 通知订单关闭
        // $ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');//测试
        $ch = curl_init('https://www.paypal.com/cgi-bin/webscr');//正式
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        $res = curl_exec($ch);

    }



}
