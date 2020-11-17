<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use Illuminate\Http\Request;
use App\Question;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $questions = Question::with('user')->latest()->paginate(5);

     return view('questions.index',compact('questions'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $question = new Question();

        return view('questions.create',compact('question'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        //

        $request->user()->questions()->create($request->only('title','body'));


        return redirect()->route('questions.index')->with('success','Your question has been submitted');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $questions =Question::findOrFail($id);

        return view('questions.edit',compact('questions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, $id)
    {
        //
        $questions = Question::findOrFail($id);

        $questions->update($request->only('title','body'));

        return redirect()->route('questions.index')->with('success',"Your question been updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
