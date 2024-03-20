<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $user) {
        $this->model = new User;
    }
    public function index(Request $request)
    {
        $search = $request->search ? $request->search : '';
        // if(!$search){
        //     $users = $this->model->get();
        //     // dd($users);
        //     return view('users.index',compact('users'));
        // }else{
            $users = $this->model->getUsers($search);
            return view('users.index',[
                'users' => $users
            ]);
        // }
    }

    public function show($id)
    {
        // $user = User::where('id',$id)->first();
        $user = $this->model->find($id);
        if(!$user){
            // return redirect()->back();
            return redirect()->route('users.index');
        }else{
            // dd('users.show',$user);
            return view('users.show',[
                'user' => $user
            ]);
        };
    }

    public function create(){
        return view('users.create');
    }

    public function store(StoreUpdateUserFormRequest $request){


        // dd($request->all());
        // $user = new User;
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = $user->password;
        // $user->save();

        if($request->image){
            $extension = $request->image->getClientOriginalExtension();
            // $path = $request->image->store('users');
            $path = $request->image->storeAs('users',now().".{$extension}");
            $data['image'] = $path;
        }

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $this->model->create($data);

        return redirect()->route('users.index');
        // return redirect()->route('users.show', $user->id);
    }

    public function edit($id){
        $user = $this->model->find($id);
        if(!$user){
            return redirect()->route('users.index');
        }else{
            return view('users.edit',[
                'user' => $user
            ]);
        };
    }
    
    public function update(StoreUpdateUserFormRequest $request, $id){
    // public function update(Request $request, $id){
        if (!$user = $this->model->find($id)){
            return redirect()->route('users.index');
        }

        // $date = $request->all();
        $date = $request->only('name','email');

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $user->update($date);

        return redirect()->route('users.index');
    }

    public function delete($id){
        $user = $this->model->find($id);
        if (!$user){
            return redirect()->route('users.index');
        }
        $user->delete();
        return redirect()->route('users.index');
    }
}
