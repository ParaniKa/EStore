<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    public function index()
    {
        $user=User::where('role','employee')->get();
        return view('admin.addemployee',compact('user'));

        
    }
    public function create()
    {
       

        return view('employee.enroll');
    }
    public function register()
    {
       

        return view('customer.customerreg');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'gender'=>'required',
            'address'=>'required',
            'mobile'=>'required',
            'role'=>'required',
            'password'=>'required',
        ]);
        

        $user=new User([
        'name'=>$request->get('name'),
        'email'=>$request->get('email'),
       'gender'=>$request->get('gender'),
        'address'=>$request->get('address'),
       'mobile'=>$request->get('mobile'),
       'role'=>$request->get('role'),
       'password'=>Hash::make($request->get('password')),

        ]);
        $user->save();
       if($request->role=='employee'){
           $users=User::all();
           return redirect()->route('user.index')->with('success','Employee created!');
        }
        else{
            return redirect()->route('start')->with('success','Customer created!');
        }

    }
        public function show(User $user)
        {
            return view('employee.show',compact('user'));
        }

        public function edit(User $user)
        {
             return view('employee.edit',compact('user'));
        }

        public function update(Request $request, User $user)
         {
                 $request->validate([
                 'name'=>'required',
                    'email'=>'required',
          
                 ]);
                 $user->update($request->all());
                return redirect()->route('user.index');
        }
        public function destroy(User $user)
         {
                $user->delete();
                return redirect()->route('user.index');
         }
}
