<?php

namespace App\Http\Livewire\Admin;

use App\Models\Wallets;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\WalletTransactions;
use PHPUnit\Framework\Constraint\IsFalse;

class WalletLivewire extends Component
{
    use WithPagination;
    public $addBalance;
    public $modalFormVisable = false;
    public $allBalance,$inputBalance,$idPush,$idPull;
    public $search='';

    public function filter()
    {

        if($this->search != null){

            return Wallets::search($this->search);
        }else{
            return Wallets::search("%");
        }

    }

    public function rules()
    {
        return [
            'inputBalance' => ['required','number'],
        ];
    }

    public function amount()
    {
        $this->resetPage();
    }


    // public function createShowModal()
    // {
    //     $this->resetVars();
    //     $this->modalFormVisable = true;
    // }
    public function resetVars()
    {
        $this->allBalance = null;
        $this->inputBalance = null;
        $this->idPush = null;
    }


    public function push($id)
    {

        $this->idPush=$id;
        $this->modalFormVisable = true;
        $wallet= Wallets::where('id', $id)->first();
        $this->allBalance=$wallet->balance;
        // dd($this->allBalance);

    }
    public function pull($id)
    {
        $this->idPull=$id;
        $this->modalFormVisable = true;
        $wallet= Wallets::where('id', $id)->first();
        $this->allBalance=$wallet->balance;

    }

    public function save(){
        if ($this->idPush) {
            Wallets::where('id', $this->idPush)->update($this->pushPlance());
            $this->pushTransaction();
            $this->modalFormVisable = false;
            $this->resetVars();
            session()->flash('message', 'تم ايداع المبلغ بنجاح ');
            //
        }elseif ($this->idPull) {
            Wallets::where('id', $this->idPull)->update($this->pullPlance());
            $this->pullTransaction();
            $this->modalFormVisable = false;
            $this->resetVars();
            session()->flash('message', 'تم سحب المبلغ بنجاح ');
        }
    }
    public function pushTransaction(){
        $wallet= Wallets::where('id', $this->idPush)->first();
        WalletTransactions::create([
           'user_id'=>$wallet->user_id,
           'wallet_id'=>$wallet->id,
           'ref_id'=>0,
           'amount'=>$this->inputBalance,
           'is_credit'=> false,
           'reason'=>"",
        ]);
    }
    public function pullTransaction(){
        $wallet= Wallets::where('id', $this->idPull)->first();
        WalletTransactions::create([
           'user_id'=>$wallet->user_id,
           'wallet_id'=>$wallet->id,
           'ref_id'=>0,
           'amount'=>$this->inputBalance,
           'is_credit'=> true,
           'reason'=>"",
        ]);
    }

    public function pushPlance()
    {


        return[
            'balance' => ($this->allBalance) + ($this->inputBalance),
        ];
    }
    public function pullPlance()
    {
        if($this->allBalance >=  $this->inputBalance ){
            return[
                'balance' => $this->allBalance - $this->inputBalance,
            ];
        } else {
            return[
                'balance' => $this->allBalance ,
            ];
        }


    }

    public function cancel(){
        $this->resetVars();
        $this->modalFormVisable = false;

    }


    public function render()
    {

        // $wallets = Wallets::orderBy('id', 'desc')->paginate(10);

        return view('livewire.admin.wallet-livewire', [
            'wallets' => $this->filter(),
        ]);
    }
}
