<?php

class StaticPagesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($slug = null)
	{
		if (empty($slug)) {
      return View::make('static.about', ['slug'  => $slug]);
    } else {
      if (in_array($slug, ['faq','submit', 'feedback', 'badge'])) {
         return View::make('static.' . $slug, ['slug'  => $slug]);
       } else {
        return Redirect::to('/posts/all');
       }
    }
	}

  public function submit($slug = null)
  {
    if (in_array($slug, ['submit', 'feedback'])) {
      $rulesSubmit = [
        'url' =>  'required',
        'email' =>  'required|email',
        'twitter' =>  'required'
      ];

      $rulesFeedback = [
        'email' =>  'required|email',
        'feedback'  => 'required|min:10'
      ];

      $validator = Validator::make(Input::all(), $rulesSubmit);
      if ($validator->fails()) {
        // put values in a flash session
        Input::flash();
        return View::make('static.submit', ['slug'  =>  'submit'])->withErrors($validator);
      }

      // if everything is okay

      $data = ['twitter' => Input::get('twitter'), 'email'=>Input::get('email'), 'url'  =>  Input::get('url')];
      Mail::queue('emails.submission', $data, function($message)
      {
          $message->from('mustapha.hamoui@gmail.com', 'Lebanese Blogs');
          $message->to('mustapha.hamoui@gmail.com', 'Mustapha Hamoui')->subject('[ Blog Submission ]');
      });
      Session::flash('message', 'Your blog has been submitted. Please permit a few days to process it.');
      return View::make('static.submit', ['slug'  =>  'submit']);
      // if neither submit nor feedback
     } else {
      return Redirect::to('/posts/all');
     }
  }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
