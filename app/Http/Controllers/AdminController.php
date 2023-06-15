<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Reservation;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
    // Login
    function login(){
        return view('login');
    }
    // Check Login
    function check_login(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        $admin=Admin::where(['username'=>$request->username,'password'=>sha1($request->password)])->count();
        if($admin>0){
            $adminData=Admin::where(['username'=>$request->username,'password'=>sha1($request->password)])->get();
            session(['adminData'=>$adminData]);

            if($request->has('rememberme')){
                Cookie::queue('adminuser',$request->username,1440);
                Cookie::queue('adminpwd',$request->password,1440);
            }

            return redirect('admin');
        }else{
            return redirect('admin/login')->with('msg','Invalid username/Password!!');
        }
    }
    // Logout
    function logout(){
        session()->forget(['adminData']);
        return redirect('admin/login');
    }

    function dashboard(){
        $reservations=Reservation::selectRaw('count(id) as total_reservations,checkin_date')->groupBy('checkin_date')->get();
        $labels=[]; 
        $data=[];
        foreach($reservations as $reservation){
            $labels[]=date('Y-m-d', strtotime($reservation['checkin_date']));
            $data[]=$reservation['total_reservations'];
        }

        // For Pie Chart
        $rtreservations = DB::table('room_types as rt')
        ->join('rooms as r', 'r.room_type_id', '=', 'rt.id')
        ->leftJoin('reservations as b', 'b.room_id', '=', 'r.id')
        ->select('rt.title', DB::raw('COUNT(DISTINCT b.id) as total_reservations'))
        ->groupBy('rt.title')
        ->having('total_reservations', '>', 0) // Only include room types with reservations
        ->get();
    
    $plabels = [];
    $pdata = [];
    
    foreach ($rtreservations as $rreservation) {
        $roomType = $rreservation->title;
        $totalReservations = $rreservation->total_reservations;
        $plabels[] = $roomType;
        $pdata[] = $totalReservations;
    }

    
    

    // End
    

        // echo '<pre>';
        // print_r($rtreservations);

        return view('dashboard',['labels'=>$labels,'data'=>$data,'plabels'=>$plabels,'pdata'=>$pdata]);
    }

    public function testimonials()
    {
        $data=Testimonial::all();
        return view('admin_testimonials',['data'=>$data]);
    }

    public function destroy_testimonial($id)
    {
       Testimonial::where('id',$id)->delete();
       return redirect('admin/testimonials')->with('success','Data has been deleted.');
    }

}
