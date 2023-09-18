<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\Items;
use App\Models\Orders;
use Livewire\Component;
use App\Models\PayOutMethods;
use App\Models\PayOutRequest;
use App\Models\AssociationModel;


class DashboardLivewire extends Component
{
    public function render()
    {


        $users = User::count();
        $orders = Orders::Where('status' , 'pending')->count();
        $pay_out = PayOutRequest::Where('reason' , 'pending')->count();
        $items = Items::count();
        $usersMatrix = User::getMatrix();
        $ordersMatrix = Orders::getMatrix();
        $top10Orders = Orders::Where('status' , 'pending')->with('customer')->orderBy('id' , 'DESC')->limit(10)->get();
        $top10Association = AssociationModel::Where('state' , 'pending')->with('user')->orderBy('id' , 'DESC')->limit(10)->get();





        return view('livewire.admin.dashboard-livewire',[
            'users'=>$users,
            'orders'=>$orders,
            'pay_out'=>$pay_out,
            'items'=>$items,
            'usersMatrix'=> $usersMatrix ,
            'ordersMatrix' => $ordersMatrix ,
            'top10Orders' => $top10Orders ,
            'top10Association' => $top10Association

        ]);
    }
}
