<?php

namespace App\Http\Controllers\MobileAPI;

use App\Models\Customer;
use App\Models\Box;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PobApplication;
use App\Models\VirtualBox;
use App\Models\Inboxing;
use App\Models\customer\CustomerDispatchDetails;

use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    // register customer API email,password,name,phone
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'Validation error'], 422);
        }
       
        $customer= Customer::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'name' => $request->name,
        ]);
        $token = $customer->createToken('API Token')->plainTextToken;
        return response()->json([
            'success'=>true,
            'token'=>$token,
            'user'=>$customer,
            'message' => 'Registration successful',
        ]);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->guard('customer')->attempt($credentials)) {
            $user = auth()->guard('customer')->user();
            $token = $user->createToken('API Token')->plainTextToken;
                return response()->json([
                    'success'=>true,
                    'token'=>$token,
                    'message' => 'Login successful',
                    'user' => $user
                ]);
        } else {
            // Invalid login credentials
            return response()->json([
                'message' => 'Invalid email or password.',
            ], 401);
        }
    }

    public function getBranches(){
        $branches = Branch::all();
        return response()->json($branches);
    }
    //customer pox 
    public function getAvailablePob($branch_id)
    {
        // $boxes = Box::where('branch_id', $branch)->where('available', true)->where('booked', false)->get();
        // return response()->json($boxes);
        $poxBranches = Box::where('branch_id',$branch_id)->where('available',0)->where('booked',0)->orderBy('created_at')->get();

        return response()->json($poxBranches);
    }
    public function getTakenPob($branch)
    {
        $boxes = Box::where('branch_id', $branch)->where('available', false)->where('booked', false)->get();
        return response()->json($boxes);
    }
    ///get pox box info
    public function getPobInfo($pobId)
    {
        $pob = Box::where('pob',$pobId)->orderBy('created_at')->get();

        return response()->json($pob);
    }
    public function getPobAddress($pobId)
    {
        $pob = Box::where('pob',$pobId)->orderBy('created_at')->get();

        return response()->json([
            'success'=>true,
            'data' => $pob,
        ]);
    }
  
    ///physical application
    public function pobApplication(Request $request){
        $request->validate([
            'branch_id' => 'required',
            'pob' => 'required',
            'attachment' => 'required|mimes:pdf|max:2048',
        ]);
        $attachment = $request->file('attachment');
        $attachment_name = time() . '.' . $attachment->getClientOriginalExtension();
        $attachment->move(public_path('attachments'), $attachment_name);
           $pob = Box::findorfail($request->pobox)->pob;
        $app=PobApplication::create(
            [
                'pob' => $pob,
                'branch_id' => $request->branch_id,
                'status' => 'payee',
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'pob_category' => $request->pob_category,
                'serviceType' => 'PBox',
                'year' => now()->year,
                'pob_type' => $request->pob_type,
                'amount' => $request->amount,
                'attachment' => $attachment_name,
                'is_new_customer' => 'yes',
                'customer_id' => $request->customer_id,
            ]
        );
             Box::findorfail($request->pobox)->update(['booked' => true]);
        return response()->json([
            'success'=>true,
            'message' => 'application successfully',
            'data' => $app,
        ], 201);
    }
    ///virtual pox box
    public function virtualApplication(Request $request){

        $request->validate([
            'pob_category' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'attachment' => 'required|mimes:pdf|max:2048',
        ]);
        $attachment = $request->file('attachment');
        $attachment_name = time() . '.' . $attachment->getClientOriginalExtension();
        $attachment->move(public_path('attachments'), $attachment_name);
        $app=Box::create(
            [
                'pob' => $request->pob,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'branch_id' => $request->branch_id,
                'pob_category' => $request->pob_category,
                'status' => 'payee',
                'date' => now(),
                'year' => now()->year,
                'pob_type' => $request->pob_type,
                'serviceType' => 'VBox',
                'amount' => 5000,
                'cotion' => 0,
                'booked' => true,
                'attachment' => $attachment_name,
                'customer_id' => $request->customer_id,
            ]
        );
        return response()->json([
            'success'=>true,
            'message' => 'application successfully',
            'data' => $app,
        ], 201);
    }
    //existing pox box
    public function pobRenew(Request $request){
    
        $request->validate([
            'branch' => 'required',
            'attachment' => 'required|file|max:2048|mimes:pdf',
        ]);
            $request->validate([
                'name' => '',
                'email' => 'email',
                'phone' => '',
                'existypobox' => 'required'
            ]);
           
            $attachment = $request->file('attachment');
            $attachment_name = time() . '.' . $attachment->getClientOriginalExtension();
            $attachment->move(public_path('attachments'), $attachment_name);
           $pob = Box::findorfail($request->pobox)->pob;
            #insert in Application model
            PobApplication::create(
                [
                    'pob' => $pob,
                    'branch_id' => $request->branch_id,
                    'status' => 'payee',
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'year' => now()->year,
                    'pob_category' => $request->pob_category,
                    'serviceType' => 'PBox',
                    'pob_type' => $request->pob_type,
                    'amount' => $request->amount,
                    'attachment' => $attachment_name,
                    'is_new_customer' => 'no',
                    'customer_id' =>$request->customer_id,
                ]
            );
                 Box::findorfail($request->pobox)->update(['booked' => true]);
            return response()->json([
                'success'=>true,
                'message' => 'application successfully',
                'data' => $app,
            ], 201);

}
///my  virtual pob
public function getCustomerPob($customerId)
{
    $customer = Box::where('customer_id',$customerId)->where('serviceType','VBox')->where('booked',1)->orderBy('created_at')->get();

    return response()->json([
        'success'=>true,
        'data' => $customer,
    ]);
}
///my physical pob

public function getCustomerPhysicalPob($customerId)
{
    $customer = Box::where('customer_id',$customerId)->where('serviceType','PBox')->where('booked',1)->orderBy('created_at')->get();

    return response()->json([
        'success'=>true,
        'data' => $customer,
    ]);
}
///International mails
    public function getInternationalMail($userId){
        $mails = Inboxing::where('userid',$userId)->whereIn('instatus', ['4', '5'])->orderBy('created_at')->get();
        if (!$mails) {
            return response()->json([
                'message' => 'no international mail assigned',
            ], 404);
        }
        else{
            return response()->json([
                'success'=>true,
                'data' => $mails,
            ]);
        }


    }
    ///national mails
    public function getNationalMail($customerId){
        $mails = CustomerDispatchDetails::where('customer_id',$customerId)->where('status',['4','5'])->orderBy('created_at')->get();
        if (!$mails) {
            return response()->json([
                'message' => 'no national mail received',
            ], 404);
        }
        else{
            return response()->json([
                'success'=>true,
                'data' => $mails,
            ]);
        }
    }

    public function countDriverMail($customerId)
    {
        $rowCount1 = CustomerDispatchDetails::where('customer_id',$customerId)->where('status',4)->orderBy('created_at')->get()->count();
        $rowCount2 = Inboxing::where('userid',$customerId)->where('instatus','4')->orderBy('created_at')->get()->count();
        $rowCount=$rowCount1+$rowCount2;
        return response()->json(['count' => $rowCount]);
    }
    //save customer location
    public function saveLocation(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $customerId = $request->input('customerId');

        // Assuming you have a 'customers' table with a 'customer_address' column
        $customer = Customer::find($customerId);
        $customer->customer_address = "Latitude: $latitude, Longitude: $longitude";
        $customer->save();

        return response()->json(['message' => 'Location saved successfully']);
    }

    public function updateHomeAddress(Request $request, $id){
        $customer = Box::findOrFail($id);
        // Update the customer attributes
        $customer->homeAddress = $request->homeAddress;
        $customer->homeEmail = $request->homeEmail;
        $customer->homeLocation = $request->homeLocation;
        $customer->homePhone = $request->homePhone;
        $customer->homeAddressCode = $request->homeAddressCode;
        $customer->homeVisible = $request->homeVisible;
        $customer->hasAddress = 1;
        
        // Save the changes
        $customer->save();
        
        return response()->json([
            'succes'=>true,
            'data'=>$customer,
            'message' => 'Customer address updated successfully']);    
    }
    
    public function updateOfficeAddress(Request $request, $id){
        $customer = Box::findOrFail($id);
        // Update the customer attributes
        $customer->officeAddress = $request->officeAddress;
        $customer->officeEmail = $request->officeEmail;
        $customer->officeLocation = $request->officeLocation;
        $customer->officePhone = $request->officePhone;
        $customer->officeAddressCode = $request->officeAddressCode;
        $customer->officeVisible = $request->officeVisible;
        $customer->hasAddress = 1;
        
        // Save the changes
        $customer->save();
        
        return response()->json([
            'succes'=>true,
            'data'=>$customer,
            'message' => 'Customer office address update successfully']);    
    }
    

    public function getBoxInformation($id){

        // echo $driverId;
        $customer = Box::where('id',$id)->get();

        if (!$customer) {
            return response()->json([
                'message' => 'no customer',
            ], 404);
        }

        return response()->json($customer);

    } 
}


