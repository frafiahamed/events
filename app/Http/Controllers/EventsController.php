<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Events;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;

class EventsController extends BaseController
{
    public function preLoginEvents(Request $request)
    {
        if(Auth::check()){
            return view('Events.postevents');
        } else {

            $results = Events::limit(10)->orderBy('id', 'desc')->get();

            return view('Events.preevents', [
                'datalist' => $results
            ]);
        }
    }

    public function Events(Request $request)
    {
        if(Auth::check()){
            $searchData['event_name'] = $request->event_name;
            $searchData['start_date'] = $request->start_date;
            $searchData['end_date'] = $request->end_date;

            $data = [];

            return view('Events.postevents', [
                'datalist' => $data
            ]);
        }
   
        return redirect("/")->withSuccess('You are not allowed to access');
    }

    public function addEvents(Request $request)
    {
        if(Auth::check()){
            return view('Events.addevent');
        }
        
        return redirect("/")->withSuccess('You are not allowed to access');
    }

    public function customAddEvent(Request $request)
    { 
        $request->validate([
            'event_name' => 'required|string|max:255|min:4|unique:events',
            'start_date' => 'required|date|after:yesterday',
            'end_date' => 'required|date|after_or_equal:start_date',
            'email_id.*' => 'required|email'
        ]);
        
        $data = $request->all();
        $check = $this->createEvents($data);

        $sendData['event_id'] = 1;
        $sendData['email_ids'] = json_encode($data['email_id']);
        $sendData['event_name'] = $data['event_name'];
        $sendData['start_date'] = $data['start_date'];
        $sendData['end_date'] = $data['end_date'];

        if(env('MAIL_STATUS') == 1){
            $this->send($sendData);
        }

        return redirect("events-list")->withSuccess('You have Created Event Successfully');
    }

    public function createEvents(array $data)
    {
      return Events::create([
        'event_name'    => $data['event_name'],
        'start_date'    => $data['start_date'],
        'end_date'      => $data['end_date'],
        'email_ids'     => json_encode($data['email_id']),
        'status'        => 1
      ]);
    }

    public function getListEvents(array $data){ 
        $results = Events::all()->sortDesc();

        return $results;
    }

    public function customEventSearch(Request $request){
        
        if(!Auth::check()){
            return redirect("/")->withSuccess('You are not allowed to access');
        }      
        

        $event_name = $request->event_name;
        $start_date = $request->start_date;
        $end_date   = $request->end_date;

        $dataSearch = Events::where('event_name','!=', '');



        if(!empty($event_name)){
            $dataSearch->where('event_name', 'like', "%$event_name%");
        }

        if(!empty($start_date)){
            $dataSearch->where('start_date', '>=', $start_date);
        }

        if(!empty($end_date)){
            $dataSearch->where('end_date', '<=', $end_date);
        }

        $dataSearch->orderBy('id', 'desc');

        $dataSearch->get();

        $data = $dataSearch->paginate(10);

        return view('Events.postevents', [
            'datalist' => $data
        ])->with('i', (request()->input('page',1) - 1) * 10);

    }


    public function send($data)
    {
        $emailids = json_decode($data['email_ids']);

        foreach($emailids as $email){
            Mail::send('email.send', ['email' => $email,'event_name' => $event_name,'start_date' => $start_date,'end_date' => $end_date], function ($message) use ($email)
            {
                $message->from('developer@gmail.com', 'Ahamed');
                $message->to($email);
            });
        }        
    }
}
