<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Status;
use App\Models\Follower;
use Auth;
use Mail;
/**
 * 
 */
class UsersController extends Controller
{

public function __construct(){
$this->middleware('auth',[
'except' => ['create','store','confirmEmail']
]);

$this->middleware('guest',[
   'only' => ['create']
]);
}

public function index(Request $request){
	$page = $request->page;
	$users = User::paginate(10);
	return view('users.index',compact(['users','page']));
}

public function create(){
	
	return view('users.create');
}

public function show(User $user){
  $statuses = $user->statuses()->orderBy('created_at','desc')->paginate(10);
  $follow = empty(Follower::where('user_id','=',$user->id)->where('follower_id','=',Auth::user()->id)->get()->toArray());
return view('users.show',compact('user','statuses','follow'));
}

public function store(Request $request){
	$this->validate($request,[
       'name' => 'required|max:50',
       'email' => 'required|email|unique:users|max:255',
       'password' => 'required|confirmed|min:6'
	]);

	$user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password)
	]);
	$this->sendEmailConfirmationTo($user);
	session()->flash('success','请登录邮箱激活');
	return redirect()->route('home');
}

public function edit(User $user){
	$this->authorize('update', $user);
return view('users.edit',compact('user'));
}

public function update(User $user,Request $request){
  $this->validate($request,[
  'name' => 'required|max:50',
  'password' => 'nullable|min:6|confirmed'
  ]);
  $this->authorize('update', $user);
  $data = [];
  $data['name'] = $request->name;
  if ($request->password) {
  	$data['password'] = $request->password;
  }
  $user->update($data);
  session()->flash('success','修改成功');
  return redirect()->route('users.show',$user->id);
}

public function destroy(User $user){
	$this->authorize('destroy', $user);
   $user->delete();
    session()->flash('success', '成功删除用户！');
     return back();
}

protected function sendEmailConfirmationTo($user){
$view = 'emails.confirm';
$data = compact('user');
$from = "864777460@qq.com";
$name = "呵呵";
$to = $user->email;
 $subject = "感谢注册 Sample 应用！请确认你的邮箱。";
 Mail::send($view,$data,function($message) use ($from,$name,$to,$subject){
$message->from($from,$name)->to($to)->subject($subject);
 });
}

public function confirmEmail($token){
 $user = User::where('activation_token',$token)->firstOrFail();
 $user->activated = 1;
 $user->activation_token = null;
 $user->save();

 Auth::login($user);
 session()->flash('success','注册成功');
 return redirect()->route('users.show',[$user]);
}

public function followings(User $user){
 $users  = $user->followings()->paginate(30);
 $title  = $user->name.'关注的人';
 return view('users.show_follow',compact('users','title'));
}

public function followers(User $user){
 $users  = $user->followers()->paginate(30);
 $title  = $user->name.'关注的人';
 return view('users.show_follow',compact('users','title'));
}


public function follow(User $user){
  $this->authorize('follow',$user);
  $user->followers()->sync([Auth::user()->id],false);
  session()->flash('success','关注成功');
  return back();
}

public function unfollow(User $user){
    $this->authorize('follow',$user);
    $user->followers()->detach([Auth::user()->id]);
     session()->flash('success','取消关注成功');
      return back();
}
}
?>