<?php

namespace App\Http\Controllers\MobileAPI;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Carneroute;
use App\Models\Calibration;
use App\Models\Customer\CustomerDispatch;
use App\Models\Eric\AirportDispach;
use Illuminate\Http\Request;
use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class UserAuthController extends Controller
{
    //driver login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;
            if ($user->level === 'driver') {
                return response()->json([
                    'success'=>true,
                    'token'=>$token,
                    'user' => $user,
                    'message' => 'Driver authenticated',
                ],200);
            } else {
                // User is not a driver, return an error
                return response()->json([
                    'message' => 'You do not have permission to access this API.',
                ], 403);
            }
        } else {
            // Invalid login credentials
            return response()->json([
                'message' => 'Invalid email or password.',
            ], 401);
        }
    }
//login status
    public function loginStatus()
    {
        if (Auth::check()) {
            // User is already logged in, return a success response
            return response()->json([
                'success' => true,
                'user' => Auth::user()
            ]);
        } else {
            // User is not logged in, return a failure response
            return response()->json([
                'success' => false
            ]);
        }
    }

    //check driver assigned national mail
    public function showDriverAssignedMail($postAgent)
    {
        $driver = CustomerDispatch::where('postAgent',$postAgent)->where('status',2)
        ->orderBy('sentDate')->get();

        if (!$driver) {
            return response()->json([
                'message' => 'no mail assigned to this driver',
            ], 404);
        }

        return response()->json([
            'success'=>true,
            'data' => $driver,
        ]);
    }
    //Internation mails
    public function showDriverAssignedInternationMail($postAgent)
    {
    
        $driver = AirportDispach::where('postAgent',$postAgent)->where('status',1)
        ->orderBy('created_at')->get();
        if (!$driver) {
            return response()->json([
                'message' => 'no international mail assigned to this driver',
            ], 404);
        }
        else{
            return response()->json([
                'success'=>true,
                'data' => $driver,
            ]);
        }

       
    }
    //Driver accept or reject mail
    public function updateMailStatus(Request $request, $id)
    {
        $driver = AirportDispach::find($id);

        if (!$driver) {
            return response()->json([
                'message' => 'Customer not found',
            ], 404);
        }
        $driver->status = 2;
        $driver->driverpickupdate = now();
                
        // Update other fields as needed
        $driver->save();

        return response()->json([
            'message' => 'Customer updated successfully',
            'data' => $driver,
        ]);
    }
    public function showRecentMail($postAgent)
    {
        $driver = CustomerDispatch::where('postAgent',$postAgent)->orderBy('sentDate')->get()->limit(2);

        if (!$driver) {
            return response()->json([
                'message' => 'no mail assigned to this driver',
            ], 404);
        }

        return response()->json([
            'success'=>true,
            'data' => $driver,
        ]);
    }

    //total mails

    public function countDriverMail($postAgent)
    {
        $rowCount1 = CustomerDispatch::where('postAgent',$postAgent)->get()->count();
        $rowCount2 = AirportDispach::where('postAgent',$postAgent)->get()->count();
        $rowCount=$rowCount1+$rowCount2;
        return response()->json(['count' => $rowCount]);
    }
    //count national
    public function countNationalMail($postAgent)
    {
        $rowCount = CustomerDispatch::where('postAgent',$postAgent)->where('status',2)->get()->count();
        return response()->json(['count' => $rowCount]);
    }
    public function countInternationalMail($postAgent)
    {
        $rowCount = AirportDispach::where('postAgent',$postAgent)->where('status',1)->get()->count();
        return response()->json(['count' => $rowCount]);
    }

    public function countDeliveredMail($postAgent)
    {
        $rowCount1 = CustomerDispatch::where('postAgent',$postAgent)->where('status',2)->get()->count();
        $rowCount2 = AirportDispach::where('postAgent',$postAgent)->where('status',2)->get()->count();
        $rowCount=$rowCount1+$rowCount2;
        return response()->json(['count' => $rowCount]);
    }
    public function countPendingMail($postAgent)
    {
        $rowCount1 = CustomerDispatch::where('postAgent',$postAgent)->where('status',1)->get()->count();
        $rowCount2 = AirportDispach::where('postAgent',$postAgent)->where('status',1)->get()->count();
        $rowCount=$rowCount1+$rowCount2;
        return response()->json(['count' => $rowCount]);
    }
    ///
    public function getDriverVehicle($driverId){

        // echo $driverId;
        $driver = Vehicle::where('driverid',$driverId)->get();

        if (!$driver) {
            return response()->json([
                'message' => 'no car',
            ], 404);
        }

        return response()->json($driver);

    }
    public function saveRoute(Request $request)
{
   
    $driver= Carneroute::create([
        'userId' => $request->userId,
        'km_out' => $request->km_out,
        'km_in' => '',
        'datetimeIn'=>'',
        'dateTimeOut'=>$request->dateTimeOut,
        'destination'=>$request->destination,
        'date'=>$request->date,
        'plate_number'=>$request->plate_number,
        'car_name'=>$request->car_name,
        'car_type'=>$request->car_type,
    ]);
    return response()->json([
        'success'=>true,
        'user'=>$driver,
        'message' => 'successful',
    ]);
}
///well done
public function showDriverRoute($driverId)
    {
        $driver = Carneroute::where('userId',$driverId)
        ->orderBy('date')->get();

        if (!$driver) {
            return response()->json([
                'message' => 'no data',
            ], 404);
        }

        return response()->json([
            'success'=>true,
            'data' => $driver,
        ]);
    }
    public function update(Request $request, $id){
    $driver = Carneroute::findOrFail($id);
    // Update the customer attributes
    $driver->km_in = $request->km_in;
    $driver->datetimeIn = $request->datetimeIn;
    // Add more attributes as needed
    
    // Save the changes
    $driver->save();
    
    return response()->json([
        'succes'=>true,
        'data'=>$driver,
        'message' => 'Customer updated successfully']);    
}
public function saveCalibration(Request $request)
{
   
    $driver= Calibration::create([
        'userId' => $request->userId,
        'liters'=> $request->liters,
        'milleage'=> $request->milleage,
        'date'=>$request->date,
        'plate_number'=>$request->plate_number,
        'car_name'=>$request->car_name,
        'car_type'=>$request->car_type,
    ]);
    return response()->json([
        'success'=>true,
        'user'=>$driver,
        'message' => 'successful',
    ]);
}
public function showDriverMilleage($driverId)
    {
        $driver = Calibration::where('userId',$driverId)
        ->orderBy('date')->get();

        if (!$driver) {
            return response()->json([
                'message' => 'no data',
            ], 404);
        }

        return response()->json([
            'success'=>true,
            'data' => $driver,
        ]);
    }
    //logout
    public function logout()
    {
        Auth::logout();

        ///logout useer

        // Perform any additional logout-related tasks, if needed
        return response()->json([
            'success'=>true,
            'message' => 'Logout successful'
        ]);
    }


}
