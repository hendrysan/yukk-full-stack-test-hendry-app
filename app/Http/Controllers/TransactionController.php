<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public static $imagePath = '/uploads/transactions';
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $model = Transaction::query();
            return DataTables::eloquent($model)
                ->addIndexColumn()
                ->addColumn('currency', function ($row) {
                    return 'Rp. ' . number_format($row->amount, 2);
                })
                ->toJson();
        }

        $total = Transaction::where('user_id', auth()->user()->id)->sum('amount');
        return view('cms.transactions.index', compact('total'));
    }

    public function create()
    {
        return view('cms.transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'note' => 'required|string',
        ]);

        $transaction = new Transaction();
        $transaction->id = Str::uuid();
        $transaction->amount = $request->amount;
        $transaction->note = $request->note;
        $transaction->type = $request->type;
        $transaction->code = Str::random(10);
        
        $transaction->user_id = auth()->user()->id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path(static::$imagePath);
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $transaction->image = static::$imagePath . '/' . $name;
        }

        $transaction->save();

        return redirect()->route('transactions')->with('success', 'Transaction created successfully');
    }
}
