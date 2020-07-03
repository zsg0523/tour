<?php

namespace App\Admin\Controllers;

use App\Exceptions\InvalidRequestException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use App\Admin\Extensions\OrdersExporter;


class OrdersController extends AdminController
{
    use ValidatesRequests;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '订单';

    /** [show 订单详情] */
    public function show($id, Content $content)
    {
        return $content
              ->header('查看订单')
              ->body(view('admin.orders.show', ['order' => Order::find($id)]));
    }

    /** [ship 订单发货] */
    public function ship(Order $order, Request $request)
    {
        // 判断当前订单是否已支付
        if (!$order->paid_at) {
            throw new InvalidRequestException('该订单未付款');
        }
        // 判断当前订单发货状态是否为未发货
        if ($order->ship_status !== Order::SHIP_STATUS_PENDING) {
            throw new InvalidRequestException('该订单已发货');
        }
        // Laravel 5.5 之后 validate 方法可以返回校验过的值
        $data = $this->validate($request, [
            'express_company' => ['required'],
            'express_no'      => ['required'],
            'express_info'    => ['required'],
        ], [], [
            'express_company' => '物流公司',
            'express_no'      => '物流单号',
            'express_info'    => '物流信息',
        ]);
        // 将订单发货状态改为已发货，并存入物流信息
        $order->update([
            'ship_status' => Order::SHIP_STATUS_DELIVERED,
            // 我们在 Order 模型的 $casts 属性里指明了 ship_data 是一个数组
            // 因此这里可以直接把数组传过去
            'ship_data'   => $data,
        ]);

        // 返回上一页
        return redirect()->back();
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order);

        $grid->column('no', __('流水号'));
        $grid->column('user.name', __('买家'))->filter();
        $grid->column('email', __('邮箱'));
        $grid->column('total_amount', __('总金额'))->sortable();
        $grid->column('paid_at', __('支付时间'));
        $grid->column('payment_method', __('支付方式'));
        $grid->column('ship_status', __('物流状态'))->display(function ($ship_status){
            return Order::$shipStatusMap[$ship_status];
        });
        $grid->column('refund_status', __('退款状态'))->display(function ($refund_status){
            return Order::$refundStatusMap[$refund_status];
        });
        $grid->column('created_at', __('创建时间'))->sortable();
        $grid->column('updated_at', __('更新时间'))->sortable();

         // 禁用创建按钮，后台不需要创建订单
        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            // 禁用删除和编辑按钮
            $actions->disableDelete();
            $actions->disableEdit();
        });
        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });
        $grid->disableExport(false);
        $grid->model()->orderBy('created_at', 'desc');
        $grid->exporter(new OrdersExporter());
        
        return $grid;
    }



}
