<?php

namespace App\Http\Livewire\Admin;

use App\Models\Rols;
use App\Models\User;
use App\Models\Orders;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\OrdersDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
//d220658844136445
class Order extends Component
{
    use WithPagination;

    public $orderId, $delivery_id;
    public $search = '';
    public $modalFormVisable = false;

    public function filter()
    {

        if($this->search != null){

            return Orders::search($this->search);
        }else{
            return Orders::search("%");
        }

    }
    public function buttonDelivery($id)
    {

        $this->orderId = $id;
        $this->modalFormVisable = true;
        // $this->resetVars();
    }

    public function resetVars()
    {
        $this->orderId = null;
    }

    public function data()
    {
        return [
            'delivery_id' => $this->delivery_id,

        ];
    }

    public function update()
    {
        Orders::find($this->orderId)->update($this->data());
        $this->modalFormVisable = false;
        Orders::updateOrderStatus($this->orderId, "approved");
        $this->resetVars();
        session()->flash('message', ' تمت الموافقه ع  الطلب واختيار عامل التوصيل بنجاح ');

    }
    public function completed($id)
    {
        Orders::updateOrderStatus($id, "completed");
        Orders::updateWallet($id);
        $this->resetVars();
        session()->flash('message', 'تم اكتمال الطلب  بنجاح ');
    }
    public function cancelld($id)
    {
        Orders::updateOrderStatus($id, "cancelld");
        $this->resetVars();
        session()->flash('message', 'تم الغاء الطلب  بنجاح ');

    }



    public function render()
    {
        // $orders = Orders::orderBy('id', 'asc')->paginate(10);
        // select customer.id as customerid , delivery.name as deliveryname
        // $orders = Orders::where('name', 'like', '%' . $this->search . '%')->orderBy('id', 'asc')->paginate(10);






        $deliveries = User::where('role_id', 2)->get();
        return view('livewire.admin.order', [
            'orders' =>     $this->filter(),
            'deliveries' => $deliveries,
        ]);
    }
}
