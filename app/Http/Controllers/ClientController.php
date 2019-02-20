<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientPost;
use App\Http\Requests\redirectToShowPost;
use Illuminate\Validation\ValidationException;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.client.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientPost $request)
    {
        $matrix = [];
        $inputArr = [];

        for($i=1; $i<=90; $i++) {
            $inputArr[$i] = $i;
        }

        for($i=0; $i<5; $i++) {
            $randomArr = array_rand($inputArr, 5);
            $matrix[] = $randomArr;
            foreach ($randomArr as $key => $value) {
                unset($inputArr[$value]);
            }
        }

        Client::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'matrix' => json_encode($matrix),
            'refresh' => 0
        ]);

        return redirect()->route('guest.show', ['id' => $request->input('phone')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::where('phone', $id)->firstOrFail();

        if ($client->refresh) {
            $matrix = [];
            $inputArr = [];

            for($i=1; $i<=90; $i++) {
                $inputArr[$i] = $i;
            }

            for($i=0; $i<5; $i++) {
                $randomArr = array_rand($inputArr, 5);
                $matrix[] = $randomArr;
                foreach ($randomArr as $key => $value) {
                    unset($inputArr[$value]);
                }
            }

            $client->update([
                'matrix' => json_encode($matrix),
                'refresh' => 0
            ]);
        }

        $matrix = json_decode($client->matrix, true);

        return view('layouts.client.show', compact('matrix', 'client'));
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
        \DB::table('clients')->update(['refresh' => 1]);

        return 'done';
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

    public function alreadyHaveAccount()
    {
        return view('layouts.client.have-account');
    }

    public function redirectToShow(Request $request)
    {
        $client = Client::where('phone', $request->input('phone'))->first();

        if(empty($client)) {
            $errors['phone'] = 'Phone number does not exist';
            $exception = ValidationException::withMessages($errors);
            throw $exception;
        }

        return redirect()->route('guest.show', ['id' => $request->input('phone')]);
    }
}
