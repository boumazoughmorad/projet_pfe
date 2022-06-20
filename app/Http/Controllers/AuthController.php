<?php
namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function getuser(){
        return response()->json(User::all(),200);
    }
    public function signup(Request $request)
    {
    //    $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|string|email|unique:users',
    //        'password'=>'required|min:5|max:30',
    //         // 'cpassword'=>'required|min:5|max:30|same:password',
    //          'address'=>'required|min:5|max:30',
    //          'country'=>'required|min:5|max:100',
    //          'city'=>'required|min:5|max:100',
    //          // 'image' => 'required|mimes:jpg,png|max:2048',
    //     ]);
       $user = new User([
            'name' => $request->name,
            'email' => $request->email,
           'password' => bcrypt($request->password),
           'address' => $request->address,
          'country' => $request->country,
          'city' => $request->city,
        ]);
        
        $save=$user->save();
        // return response()->json([
        //     'message' => 'Successfully created user!',
        // ], 201);
        if( $save ){
      
           // return response()->json(['message'=>'regestered'],200);
            
        // $user->roles()->attach(2); // Simple user role

        return response()->json($user);
        }else{
         
          return response()->json(['message'=>'noooooooooooooooo'],404);
            
        }
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|string|email',
    //         'password' => 'required|string',
    //         // 'remember_me' => 'boolean',
    //     ]);

    //     $credentials = request(['email', 'password']);
    //     if (!Auth::attempt($credentials)) {
    //         return response()->json([
    //             'message' => 'Unauthorized',
    //         ], 401);
    //     }

    //     $user = $request->user();
    //     $tokenResult = $user->createToken('Personal Access Token');
    //     $token = $tokenResult->token;
    //     // if ($request->remember_me) {
    //     //     $token->expires_at = Carbon::now()->addWeeks(4);
    //     // }

    //     $token->save();
    //     return response()->json([
    //         'access_token' => $tokenResult->accessToken,
    //         'token_type' => 'Bearer',
    //         'expires_at' => Carbon::parse(
    //             $tokenResult->token->expires_at
    //         )->toDateTimeString(),
    //     ]);
    // }
    public function login(Request $request)
{
    $request->validate([
        'email' => 'email|required',
        'password' => 'required'
    ]);

    $credentials = request(['email', 'password']);
    if (!auth()->attempt($credentials)) {
        return response()->json([
            'message' => 'The given data was invalid.',
            'errors' => [
                'password' => [
                    'Invalid credentials'
                ],
            ]
        ], 422);
    }

    $user = User::where('email', $request->email)->first();
    $authToken = $user->createToken('auth-token')->plainTextToken;
    $id=$user->id;
    return response()->json([
        'token' => $authToken,
        'idUser'=>$id,
    ]);
}

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
    

}
