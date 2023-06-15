<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $data=Guest::all();
        return view('guest.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guest.create');
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
            'full_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'mobile' => 'required',
            'photo.*' => 'image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $uploadedPaths = [];

        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $file) {
                $uploadedPaths[] = $file->store('public/imgs');
            }
        }

        $data = new Guest;
        $data->full_name = $request->full_name;
        $data->email = $request->email;
        $data->password = sha1($request->password);
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->photo = implode(',', $uploadedPaths);
        $data->save();

        return redirect('admin/guest/create')->with('success', 'Data has been added.');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Guest::find($id);
        return view('guest.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data=Guest::find($id);
        return view('guest.edit',['data'=>$data]);
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
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
        ]);

        $data = Guest::find($id);
        $data->full_name = $request->full_name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;

        if ($request->hasFile('photo')) {
            $imgPath = $request->file('photo')->store('public/imgs');
            $data->photo = $imgPath;
        }

        $data->save();

        return redirect('admin/guest/'.$id.'/edit')->with('success', 'Data has been updated.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Guest::where('id',$id)->delete();
       return redirect('admin/guest')->with('success','Data has been deleted.');
    }

    // Login
    function login(){
        return view('frontlogin');
    }

    // Check Login
    function Guest_login(Request $request){
        $email=$request->email;
        $pwd=sha1($request->password);
        $detail=Guest::where(['email'=>$email,'password'=>$pwd])->count();
        if($detail>0){
            $detail=Guest::where(['email'=>$email,'password'=>$pwd])->get();
            session(['Guestlogin'=>true,'data'=>$detail]);
            return redirect('/');
        }else{
            return redirect('login')->with('error','Invalid email/password!!');
        }
    }

    // register
    function register(){
        return view('register');
    }

    // Logout
    function logout(){
        session()->forget(['Guestlogin','data']);
        return redirect('login');
    }
}
