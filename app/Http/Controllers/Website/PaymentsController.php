<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Exceptions\InvalidRequestException;
use Carbon\Carbon;
use App\Events\OrderPaid;
use Illuminate\Support\Facades\Mail;
use App\Mail\GuestOrderPaid;

class PaymentsController extends Controller
{

    /** [afterPaid 设置事件触发器] */
    protected function afterPaid(Order $order)
    {
        event(new OrderPaid($order));
    }

    /**
     * [payByPayPalCheckout paypal支付]
     * @param  Order   $order   [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */ 
    public function payByPayPal(Order $order, Request $request)
    {
        
        // 判断订单状态
        if ($order->paid_at || $order->closed) {
            throw new InvalidRequestException('订单状态不正确');
        }
        // 得到支付的链接
        $data =
        [
            'address'      =>'https://www.sandbox.paypal.com/cgi-bin/webscr',//测试沙盒,该环境不可用CNY
            // 'address'      =>'https://www.paypal.com/cgi-bin/webscr',//正式地址
            'cmd'          =>'_xclick',
            'business'     =>'paypal@ifn-asia.org',//测试商户账号
            // 'business'     =>'ac.dept@shtoys.com.hk',
            'item_name'    =>$order->remark ?? '支付 Wenno Shop 的订单：'.$order->no, // 订单描述
            'item_number'  =>$order->no,  // 商品编号
            'invoice'      =>$order->no, // 订单编号
            'currency_code'=>'HKD', // 货币种类
            'no_shipping'  =>'1',
            'amount'       =>$order->total_amount,   // 商品金额，总价
            'notify_url'   =>route('api.paypal.notify'), // 后端回调地址
            'cancel_return'=>'', // 客户取消交易返回地址
            'return'       =>route('api.paypal.return'), // 客户交易返回地址
        ];

        // 拼接组装url
        $url  = $data['address'].'?cmd='.$data['cmd'].'&business='.$data['business'].'&item_name='.$data['item_name'].'&item_number='.$data['item_number'].'&invoice='.$data['invoice'].'&currency_code='.$data['currency_code'].'&no_shipping='.$data['no_shipping'].'&amount='.$data['amount'].'&notify_url='.$data['notify_url'].'&cancel_return='.$data['cancel_return'].'&return='.$data['return'];
        
        // 支付链接
        return $this->response->array(['url' => $url]);
    }

    // Paypal前端回调
    public function payPalReturn()
    {
        return redirect('https://www.wennoanimal.com/animalGame/website/#/payResult');
    }

    // Paypal后端回调
    // mc_gross=13.00&invoice=20200611172210056683&protection_eligibility=Ineligible&payer_id=3BGBC8NXLU3SE&payment_date=03%3A11%3A45+Jun+11%2C+2020+PDT&payment_status=Pending&charset=windows-1252&first_name=John&notify_version=3.9&custom=&payer_status=verified&quantity=1&verify_sign=A7bVkXNneIKOuae9kjm7b3Fry1IvAOKuXBTuZSU8sn8oKqGyEZsv1bvV&payer_email=sb-r5exh1138848%40business.example.com&txn_id=5RT543922R8916204&payment_type=instant&payer_business_name=John+Doe%27s+Test+Store&last_name=Doe&receiver_email=paypal%40ifn-asia.org&shipping_discount=0.00&pending_reason=unilateral&insurance_amount=0.00&txn_type=web_accept&item_name=test&discount=0.00&mc_currency=HKD&item_number=20200611172210056683&residence_country=CN&test_ipn=1&shipping_method=Default&transaction_subject=&payment_gross=&ipn_track_id=5503e73fbb57a
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
        if ($order->email) {
            // 给游客发送邮件
            Mail::to($order->email)->send(new GuestOrderPaid($order));
        } else {
            // 给会员发送邮件
            $this->afterPaid($order);
        }

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
