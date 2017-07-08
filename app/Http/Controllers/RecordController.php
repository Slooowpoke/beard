<?php

namespace App\Http\Controllers;

use View;
use App\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
	/**
     * Display a listing of the record.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$records = Record::all();
		// lets sort this array before sending it
		$records = $records->sort(function($a, $b)
		{
		    $a = ($a->upvotes) - ($a->downvotes);
		    $b = ($b->upvotes) - ($b->downvotes);
		    //here you can do more complex comparisons
		    //when dealing with sub-objects and child models
		    if ($a === $b) {
		        return 0;
		    }
		    return ($a < $b) ? 1 : -1;
		});

		return view('records.create', compact('records'));
    }

    /**
     * Show the form for creating a new record.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$records = Record::all();

		return view('records.create', compact('records'));
    }

    /**
     * Store a newly created record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, [
		   'data' => 'required',
	   ]);

	   $result = Record::create($request->all());
    }

	public function upvote(Request $request){
		$id = $request->id;
		$record = Record::find($id);
		$record->upvotes = ($record->upvotes)+1;
		$record->save();
	}

	public function downvote(Request $request){
		$id = $request->id;
		$record = Record::find($id);
		$record->downvotes = ($record->downvotes)+1;
		$record->save();
	}

    /**
     * Display the specified record.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
		$record = Record::find($request->id);
		return view('records.show', compact('record'));
    }

    /**
     * Update the specified record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
		$this->validate($request, [
			'name' => 'required',
			'description' => 'required',
		]);

		$record->update($request->all());
		return redirect()->route('records.index')
						->with('success','Item updated successfully');
    }

}
