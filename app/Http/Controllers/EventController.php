<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request  $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name'               =>       'required',
            'start_date'         =>       'required',
            'end_date'           =>       'required',
            'time'               =>       'required',
            'description'        =>       'required',
            'country'            =>       'required',
            'category'           =>       'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if (!empty($errors)) {
                foreach ($errors->all() as $error) {
                    return (($error));
                }
            }
        } else {
            $details    =   [
                'name'          =>           $data['name'],
                'start_date'    =>           $data['start_date'],
                'end_date'      =>           $data['end_date'],
                'time'          =>           date('Y-m-d H:i', strtotime($data['time'])),
                'description'   =>           $data['description'],
                'country'       =>           $data['country'],
                'category'   =>              $data['category'],
            ];  
            $event = Event::create($details);
            if ($event) {
                return (('event Details Added.'));
            } else {
                return ('Something Went Wrong.');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->section  = 'Event';
        $this->view     = 'events';
    }
    public function index()
    {
        
        $section = $this->section;
        $events = Event::where('user_role', 1)->get();
        

        return view($this->view . '.index', compact('events', 'section'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
