<?php

namespace App\Http\Livewire\Admin;

use App\Models\Orders;
use App\Models\Address;
use App\Models\Wallets;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AssociationModel;
use App\Models\WalletTransactions;
use App\Models\PersonalInformation;




class UserDetailsLivewire extends Component
{
    use WithPagination;
public $userId;
    public function mount($id){
        $this->userId=$id;
    }



           public function createWallet(){

            return[
                'user_id' =>$this->userId,
                'balance'=>0,
            ];
            }

    public function render()
    {
        //info
        $userInfo = PersonalInformation::where('user_id', $this->userId)->first();
        //addres
        $userAddresses = Address::where('user_id', $this->userId)->first();
        //all adressees
        $adressees=Address::where('user_id',$this->userId)->orderBy('id','desc')->paginate(10);
        // associations
        $associations=AssociationModel::where('user_id',$this->userId)->orderBy('id','desc')->paginate(10);
        //orders
        $orders=Orders::where('customer_id',$this->userId)->orderBy('id','desc')->paginate();
        //wallet transaction
        $w_transactions=WalletTransactions::where('user_id',$this->userId)->orderBy('id','desc')->paginate(10);
        //
        $balance_wallet=Wallets::where('user_id',$this->userId)->first();

        if (is_null($balance_wallet)) {

            Wallets::create($this->createWallet());
        }



        return view('livewire.admin.user-details-livewire',[
            'userInfo'=>$userInfo,
            'userAddresses'=>$userAddresses,
            'adressees'=>$adressees,
            'associations'=>$associations,
            'orders'=>$orders,
            'w_transactions'=>$w_transactions,
            'balance_wallet'=>$balance_wallet,
        ]);
    }
}
