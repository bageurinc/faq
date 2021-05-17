<?php

namespace Bageur\FAQ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bageur\FAQ\model\faq;
use Validator;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $faq = faq::datatable($request);
        return $faq;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $rules    	= [
                        'pertanyaan'		     		=> 'required',
                        'jawaban'		     		    => 'required'
                    ];

        $messages 	= [];
        $attributes = [];

        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response(['status' => false ,'error'    =>  $errors->all()], 200);
        }else{
            $faq               = new faq;
            $faq->pertanyaan   = $request->pertanyaan;
            $faq->jawaban      = $request->jawaban;
            $faq->status       = $request->status;
            $faq->save();

            return response(['status' => true ,'text'    => 'has input'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faq = faq::findOrFail($id);
        return $faq;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules    	= [
                    'pertanyaan'		     		=> 'required',
                    'jawaban'		     		    => 'required'
                    ];

        $messages 	= [];
        $attributes = [];

        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response(['status' => false ,'error'    =>  $errors->all()], 200);
        }else{

            $faq               = faq::findOrFail($id);
            $faq->pertanyaan   = $request->pertanyaan;
            $faq->jawaban      = $request->jawaban;
            $faq->status       = $request->status;
            $faq->save();

            return response(['status' => true ,'text'    => 'has update'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = faq::findOrFail($id);
        $delete->delete();
        return response(['status' => true ,'text'    => 'has deleted'], 200);
    }

    public function urutan(Request $request)
    {
        $up         = faq::find($request->id);
        $up->urutan = $request->urutan_baru;
        $up->update();

        $up2        = faq::find($request->id_old);
        $up2->urutan = $request->urutan_sekarang;
        $up2->update();
    }
}
