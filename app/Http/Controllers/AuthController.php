<?php

namespace App\Http\Controllers;

use App\Http\Models\Bus;
use App\Http\Models\BusTrip;
use App\Http\Models\PassengerBooking;
use Illuminate\Http\Request;
use App\Http\Models\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use DB, Hash, Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

class AuthController extends Controller
{
    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ];
        $input = $request->only(
            'name',
            'email',
            'password',
            'password_confirmation'
        );
        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json(['success'=> false, 'error'=> $error]);
        }
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $user = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
        $verification_code = str_random(30); //Generate verification code
        DB::table('user_verifications')->insert(['user_id'=>$user->id,'token'=>$verification_code]);
        $subject = "Please verify your email address.";
        Mail::send('email.verify', ['name' => $name, 'verification_code' => $verification_code],
            function($mail) use ($email, $name, $subject){
                $mail->from(getenv('FROM_EMAIL_ADDRESS'), "From User/Company Name Goes Here");
                $mail->to($email, $name);
                $mail->subject($subject);
            });
        return response()->json(['success'=> true, 'message'=> 'Thanks for signing up! Please check your email to complete your registration.']);
    }
    public function login(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        $input = $request->only('username', 'password');
        $validator = Validator::make($input, $rules);

        if($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json(['success'=> false, 'error'=> $error]);
        }

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];
        
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'Invalid Credentials. Please make sure you entered the right information and you have verified your email address.'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'could_not_create_token'], 500);
        }
        // all good so return the token
        return response()->json(['success' => true,  'token' => $token ]);
    }

    public function logout(Request $request)
    {
        $this->validate($request, ['token' => 'required']);
        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    }

    public function user()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Exception $e) {

            return response()->json(['token_expired'], 404);

        } catch (Exception $e) {

            return response()->json(['token_invalid'], 404);

        } catch (Exception $e) {

            return response()->json(['token_absent'], 404);

        }
        $user->passenger;
        $user->driver;
        $hasTrip = false;
        $tripId = 0;
        if ($user->passenger_id != 0) {
            $trip = PassengerBooking::where('passenger_id', $user->passenger_id)->first();
            if ($trip) {
                $hasTrip = true;
                $tripId = $trip->bus_trip_id;
            }
        } elseif ($user->driver_id != 0) {

            $bus = Bus::where('driver_id', $user->driver_id)->with('busTrip')->get();

            if ($bus[0]->busTrip) {
                $hasTrip = true;
                $tripId = $bus[0]->busTrip['id'];
            }
        }
        $response = [
            'user' => $user,
            'hasTrip' => $hasTrip,
            'tripId' => $tripId
        ];

        return response()->json($response);

    }

}
