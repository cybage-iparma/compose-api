<?php

namespace App\Http\Controllers;

use App\Models\MessageTemplate;
use App\Http\Requests\StoreMessageTemplateRequest;
use App\Http\Requests\UpdateMessageTemplateRequest;

class MessageTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageTemplateRequest $request)
    {

        $insertedData = MessageTemplate::create([
            'customer_id' => $request->input('customer_id'),
            'message_category_id' => $request->input('message_category_id'),
            'template_name' => $request->input('template_name'),
            'template_content_json' => $request->input('template_content_json'),
            'template_content_mjml' => $request->input('template_content_mjml'),
        ]);

        return response()->json(['success' => true, 'data' => $insertedData], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(MessageTemplate $messageTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MessageTemplate $messageTemplate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageTemplateRequest $request, MessageTemplate $messageTemplate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MessageTemplate $messageTemplate)
    {
        //
    }
}
