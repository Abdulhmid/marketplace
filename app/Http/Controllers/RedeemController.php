<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Redeem;
use App\User;
use App\Ledger;
use DataTables;
use Redirect,Response;
use Auth;

class RedeemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Redeem::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('user_id', function($row){
                            return User::find($row->user_id)->name;
                    })
                    ->editColumn('status', function($row){
                            $statusDisplay='Active';
                            if ($row->status ==0) {
                                $statusDisplay='Ditolak';
                            } elseif ($row->status ==1) {
                                $statusDisplay='Menunggu';
                            }elseif ($row->status ==2) {
                                $statusDisplay='Disetujui';
                            }
                        
                            return $statusDisplay;
                    })
                    ->editColumn('created_at', function($row){
                            return $row->created_at->format('d/F/Y')
                                    .' by '.ucfirst($row->created_by);
                    })
                    ->editColumn('updated_at', function($row){
                            return $row->updated_at->format('d/F/Y')
                                    .' by '.ucfirst($row->updated_by);
                    })
                    ->addColumn('action', function($row){
                        if (\GlobalHelper::session()=='admin') {
                            if ($row->status <> 1) {
                                return "-";
                            }else{
                                $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-status="2" data-original-title="Setujui" class="btn btn-sm btn-outline-info py-0 approveAction">Setujui</a>';
                                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-status="0" data-original-title="Tolak" class="btn btn-sm btn-outline-danger py-0 rejectAction">Tolak</a>';
                                return $btn;
                            }
                        }else{
                            return "-";
                        }
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('modules.redeem.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.redeem.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $isEdit = $request['id'];

        $rulesData = $request->validate([
          'user_id' => 'required',
          'nominal' => 'required',
          'description' => 'required'
        ]);

        if (isset($isEdit)) {
            $rulesData['updated_by'] = Auth::user()->id;
            $rulesData['updated_at'] = \Carbon\Carbon::now();
            Redeem::whereId($isEdit)->update($rulesData);
            $this->meesage('message','Redeem updated successfully!');
            return redirect('redeem');
        }

        Redeem::create([
            'user_id' => $request->user_id,
            'nominal' => $request->nominal,
            'description' => $request->description,
            'created_by' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_by' => Auth::user()->id,
            'updated_at' => \Carbon\Carbon::now()
        ]);

        $this->meesage('message','Pengajuan pencairan dana berhasil dikirimkan!');
        return redirect('redeem');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Redeem $roles,$id)
    {
        $row = $roles->where('id', $id)->first();
        return view('modules.redeem.form',[
            'row' => $row
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function redeemchange(
        Request $request, 
        Redeem $redeem,
        Ledger $ledger, 
        User $user, 
        $id,
        $status
    )
    {
        $rowRedeem = $redeem->where('id', $id);
        $rowRedeem->update([
                'status' => $status
            ]);

        if ($status==2) {
            // Update ledger & coloumn saldo
            $newSaldoSeller = $user->where('id',$rowRedeem->first()->user_id)
                                ->first()->saldo - $rowRedeem->first()->nominal;
            $ledger->create([
                'status' => 1,
                'user_id' => $rowRedeem->first()->user_id,
                'saldo' => $newSaldoSeller,
                'debit' => $rowRedeem->first()->nominal, // pengurangan
                'credit' => 0, // penambahan
                'description' => " # Pencairan saldo hasil penjualan",
                'transaction_code' => '-',
                'created_by' => \Auth::user()->id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_by' => 0,
                'updated_at' => \Carbon\Carbon::now(),
            ]);
            $user->where('id',$rowRedeem->first()->user_id)->update([
                'saldo' => $newSaldoSeller
            ]);
        }

        $this->meesage('message','Pengajuan sudah berhasil di update!');
        return redirect()->back();
    }

    public function meesage(string $name = null, string $message = null)
    {
        return session()->flash($name,$message);
    }
}
