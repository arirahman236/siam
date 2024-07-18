<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Emsmhs;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required',
    //         'c_password' => 'required|same:password',
    //     ]);

    //     if ($validator->fails()) {
    //         return $this->sendError('Validation Error.', $validator->errors());
    //     }

    //     $input = $request->all();
    //     $input['password'] = bcrypt($input['password']);
    //     $user = User::create($input);

    //     $success['token'] = $user->createToken('MyApp')->accessToken;
    //     $success['name'] = $user->name;

    //     return $this->sendResponse($success, 'User registered successfully.');
    // }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
        public function loginn(Request $request)
        {
            // $credentials = [
            //     'NIMHSMSMHS' => $request->NIMHSMSMHS,
            //     'PASSWORD' => $request->PASSWORD
            // ];

            if (Auth::attempt(['NIMHSMSMHS' => $request->NIMHSMSMHS, 'password' => $request->PASSWORD])){
                $user = Auth::user();
                $success['token'] = $user->createToken('MyApp')->accessToken;
                $success['NIMHSMSMHS'] = $user->NIMHSMSMHS;

                return $this->sendResponse($success, 'User logged in successfully.');
            } else {
                return $this->sendError('Unauthorized.', ['error' => 'Unauthorized']);
            }
        }

        public function details()
        {
            $user = Auth::user();
            return response()->json(['success' =>$user], 200);
        }

        public function logout()
        {
            $user = Auth::user()->token();
            $user->revoke();
            return response()->json(['message' => 'User logged out'], 200);
        }

}
