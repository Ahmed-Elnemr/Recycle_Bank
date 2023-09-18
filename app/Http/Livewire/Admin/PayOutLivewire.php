<?php

namespace App\Http\Livewire\Admin;

use App\Models\Wallets;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PayOutRequest;
use Illuminate\Support\Facades\DB;


class PayOutLivewire extends Component
{
    use WithPagination;
    public $newBalance;
    public $search='';
    public function filter()
    {

        if($this->search != null){

            return PayOutRequest::search($this->search);
        }else{
            return PayOutRequest::search("%");
        }

    }

    public function amount()
    {
        $this->resetPage();
    }

    public function pull($id){
    //     $payOut=PayOutRequest::where('id', $id)->first();
    //     $amount=$payOut->amount;
    //     $userId=$payOut->user_id;
    //     $wallet=Wallets::where('user_id', $userId)->select('balance')->first();
    //     // dd($wallet);
    //    $balance= $wallet->balance;
    //    $this->newBalance= $balance-$amount;
    //    PayOutRequest::where('id', $id)->update($this->newBalance());
    //    $this->resetVars();
    PayOutRequest::settleup($id);

    $this->resetVars();
    }
    public function  newBalance(){
        return [
            'balance' => $this->newBalance,
        ];
    }
    public function  resetVars(){
       $this->newBalance =null;
    }


    public function render()
    {
        // $payOuts=PayOutRequest::orderBy('id', 'desc')->paginate(10);
      
        return view('livewire.admin.pay-out-livewire',[
            'payOuts'=>$this->filter(),
        ]);
    }
}
