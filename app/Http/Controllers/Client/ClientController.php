<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientFile;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'business_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'documents.*' => 'file|max:10240', // Max 10MB files
        ]);
        ///dd($validatedData);

        $client = Client::create($validatedData);

        // Handle file uploads
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $documentDirectory = public_path('uploads/client_documents/' . $client->id);
                if (!is_dir($documentDirectory)) {
                    mkdir($documentDirectory, 0777, true);
                }
                $documentFilename = $file->getClientOriginalName();
                $file->move($documentDirectory, $documentFilename);
                // $path = $file->move('client_files', 'public');
                ClientFile::create([
                    'client_id' => $client->id,
                    'file_path' => $documentDirectory . '/' . $documentFilename,
                    'description' => $documentFilename,
                ]);
            }
        }

        return redirect()->route('clients.index')->with('success', 'Client created successfully');
    }

    public function edit(Client $client)
{
    return view('clients.edit', compact('client'));
}

public function update(Request $request, Client $client)
{
    $validatedData = $request->validate([
        'business_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'address' => 'required|string',
        'files.*' => 'file|max:10240', // Max 10MB files
    ]);

    $client->update($validatedData);

    // Handle file uploads
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $path = $file->store('client_files', 'public');
            ClientFile::create([
                'client_id' => $client->id,
                'file_path' => $path,
                'description' => $file->getClientOriginalName()
            ]);
        }
    }

    return redirect()->route('clients.index')->with('success', 'Client updated successfully');
}

public function destroy(Client $client)
{
    // This will also delete associated files due to cascade delete in migration
    $client->delete();

    return redirect()->route('clients.index')->with('success', 'Client deleted successfully');
}

public function getClients()
{
    $clients = Client::select('id', 'business_name')->get();
        return response()->json($clients);
}

}
