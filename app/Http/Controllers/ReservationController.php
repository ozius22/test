<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\RoomType;
use App\Models\Reservation;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations=Reservation::all();
        return view('reservation.index',['data'=>$reservations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guests=Guest::all();
        return view('reservation.create',['data'=>$guests]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'guest_id'=>'required',
        'room_id'=>'required',
        'checkin_date'=>'required',
        'checkout_date'=>'required',
        'total_adults'=>'required',
        'roomprice'=>'required',
    ]);

    $data=new Reservation;
    $data->guest_id=$request->guest_id;
    $data->room_id=$request->room_id;
    $data->checkin_date=$request->checkin_date;
    $data->checkout_date=$request->checkout_date;
    $data->total_adults=$request->total_adults;
    $data->total_children=$request->total_children;
    if($request->ref=='front'){
        $data->ref='front';
    }else{
        $data->ref='admin';
    }
    $data->save();

    $ref=$request->ref;
    if($ref=='front'){
        return redirect('reservation')->with('success','Data has been saved.');
    }

    return redirect('admin/reservation/create')->with('success','Data has been added.');
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
        public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        Reservation::where('id',$id)->delete();
        return redirect('admin/reservation')->with('success','Data has been deleted.');
    }


    // Check Avaiable rooms
    public function available_rooms(Request $request, $checkin_date)
    {
        $arooms = DB::table('rooms')
            ->whereNotIn('id', function ($query) use ($checkin_date) {
                $query->select('room_id')
                    ->from('reservations')
                    ->whereRaw('? BETWEEN checkin_date AND checkout_date', [$checkin_date]);
            })
            ->get();
    
        $data = [];
        foreach ($arooms as $room) {
            $roomTypes = RoomType::find($room->room_type_id);
            $data[] = ['room' => $room, 'roomtype' => $roomTypes];
        }
    
        return response()->json(['data' => $data]);
    }
    

    public function front_reservation()
    {   
        return view('front-reservation');
    }

    public function reservation_payment_success(Request $request)
    {
        //
    }
    function reservation_payment_fail(Request $request){
        return view('reservation.failure');
    }
}
