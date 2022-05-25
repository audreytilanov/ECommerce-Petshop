<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    
    public function notification(){
        return view('admin.notification');
    }

    public function home(){
        $totalTransaction = Transaction::count();
        // dd($totalTransaction);
        $json = json_encode($totalTransaction);
        $test = Transaction::select(DB::raw("(SUM(sub_total)) as sub_total"))
        ->groupBy(DB::raw("MONTH(created_at)"))
        ->get();

        $TransactionFinal = json_decode($test, true);
        // dd($TransactionFinal);
        $final = [];
        foreach ($TransactionFinal as $key => $value) {
            array_push($final, array_values($value));
        }
        $record = Transaction::select(DB::raw("COUNT(sub_total) as total"),DB::raw("SUM(sub_total) as sum"), DB::raw("MONTHNAME(created_at) as month_name"))
        ->where('created_at', '>', Carbon::today()->subMonths(6))
        ->groupBy('month_name')
        ->orderBy('created_at', 'ASC')
        ->get();
    
        $data = [];
    
        foreach($record as $row) {
            $data['label'][] = $row->month_name;
            $data['count'][] = $row->total;
            $data['data'][] = (int) $row->sum;
        }
    
        $data['chart_data'] = json_encode($data);

        $totalUser = User::count();

        $countTransaction = Transaction::count();
        $countProduct = Product::count();

        $sumTransaction = Transaction::sum('sub_total');
        return view('admin.master.dashboard', compact('totalTransaction', 'data', 'sumTransaction','totalUser', 'countTransaction','countProduct'));
    }

    public function index(){
        $data = Admin::all();
        return view('admin.master.admin.index', compact('data'));
    }

    public function create(){
        return view('admin.master.admin.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:admins,name',
            'username' => 'required|unique:admins,username',
            'email' => 'required|unique:admins,email',
            'profile_image' => 'required',
            'phone' => 'required',
            'password' => 'required|min:3',
        ]);

        $filename = Str::random(10).$request->profile_image->getClientOriginalName();
        $file = $request->file('profile_image');
// dd($file);
        Storage::disk('asset')->put('admin/foto/'.$filename, file_get_contents($file));
        // Storage::disk('asset')->put('asset/sejarah/'.$fileName, file_get_contents($file));
        $create = Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'profile_image' => $filename,
            'phone' => $request->phone,
            'password' => Hash::make($request->name),
        ]);

        if($create){
            toast('Admin berhasil ditambahkan','success');
            return redirect()->route('admin.account.index');
        }else{
            toast('Admin gagal ditambahkan','error');
            return redirect()->route('admin.account.index');
        }
        
    }

    public function edit($id){
        $data = Admin::find($id);
        return view('admin.master.admin.edit', compact('data'));
    }
    
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $data= Admin::find($id);
        
        // dd($request->file('image'));
        if($request->file('profile_image')){
            Storage::disk('asset')->delete('admin/foto/'.$data->profile_image);
            $filename = Str::random(10).$request->profile_image->getClientOriginalName();
            $file = $request->file('profile_image');
            Storage::disk('asset')->put('admin/foto/'.$filename, file_get_contents($file));

            $edit = $data->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'profile_image' => $filename,
                'phone' => $request->phone,
                'password' => Hash::make($request->name),

            ]);
        }else{
            $edit = $data->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->name),
            ]);
        }

        if($edit){
            toast('Admin berhasil diubah','success');
            return redirect()->route('admin.account.index');
        }else{
            toast('Admin gagal diubah','error');
            return redirect()->route('admin.account.index');
        }
    }

    public function delete($id){
        $data = Admin::where('id', '=', $id)->first();
        // dd($id);
        Storage::disk('asset')->delete('admin/foto/'.$data->profile_image);

        $delete = $data->delete();

        if($delete){
            toast('Admin berhasil dihapus','success');
            return redirect()->route('admin.account.index');
        }else{
            toast('Admin gagal dihapus','error');
            return redirect()->route('admin.account.index');
        }
    }
}
