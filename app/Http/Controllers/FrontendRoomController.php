<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Room;
use App\Models\RoomBookedDate;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class FrontendRoomController extends Controller
{
    public function frontendRoomAll(){
        $rooms = Room::latest()->get();
        return view('frontend.room.all_rooms', compact('rooms'));
    } //end method

    public function RoomDetailsPage($id) {
        $roomDetails = Room::find($id);
        $multiImage = MultiImage::where('room_id', $id)->get();
        $facility = Facility::where('room_id', $id)->get();
        $otherRooms = Room::where('id' ,'!=', $id)->orderBy('id', 'DESC') ->limit(2)->get();
        return view('frontend.room.room_details', compact('roomDetails', 'multiImage', 'facility', 'otherRooms'));
    } // End Method 

    public function BookingSearch(Request $request){
        $request->flash();

        if($request->check_in == $request->check_out){
            $notification = array(
                'message' => 'Something want to wrong',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
        $sdate = date('Y-m-d', strtotime($request->check_in));
        $edate = date('Y-m-d', strtotime($request->check_out));
        $alldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate, $alldate);

        $dt_array = [];
        foreach ($d_period as $period){
            array_push($dt_array, date('Y-m-d', strtotime($period)));
        }
    
        $check_date_booking_ids = RoomBookedDate::whereIn('book_date', $dt_array)->distinct()->pluck('booking_id')->toArray();

        $rooms = Room::withCount('room_number')->where('status', 1)->get();
       
        return view('frontend.room.search_room', compact('rooms', 'check_date_booking_ids'));


    }//end method
}
