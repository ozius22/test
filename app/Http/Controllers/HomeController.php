<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\Banner;
use App\Models\Roomtypeimage;
use App\Models\Service;
use App\Models\Testimonial;

class HomeController extends Controller
{

    // Home Page
    function home(){
        $services=Service::all();
        $roomTypes=RoomType::all();
        $testimonials=Testimonial::all();
        return View('home',['roomTypes'=>$roomTypes,'services'=>$services,'testimonials'=>$testimonials]);
    }

    // Service Detail Page
    function service_detail(Request $request, $id){
        $service=Service::find($id);
        return View('servicedetail',['service'=>$service]);
    }

    // Add Testimonial
    function add_testimonial(){
        return view('add-testimonial');
    }

    // Save Testimonial
    function save_testimonial(Request $request){
        $guest_id=session('data')[0]->id;
        $data=new Testimonial;
        $data->guest_id=$guest_id;
        $data->testi_cont=$request->testi_cont;
        $data->save();

        return redirect('guest/add-testimonial')->with('success','Data has been added.');
    }
}
