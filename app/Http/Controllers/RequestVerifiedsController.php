<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestVerified;

class RequestVerifiedsController extends Controller
{
    public function index()
    {
        $requests = RequestVerified::with('user')->paginate(10);
        return response()->json(
            $requests,
            200
        );
    }

    public function detail($id)
    {
        $request = RequestVerified::with('user')->find($id);
        return response()->json(
            [
                "message" => "Berhasil mendapatkan request verified",
                "request" => $request
            ],
            200
        );
    }

    public function inspectUser($id)
    {
        $request = RequestVerified::with('user')->where('user_id', '=', $id)->get();
        return response()->json(
            $request,
            200
        );
    }

    public function store(Request $request)
    {
        $reqverified = new RequestVerified();
        $reqverified->note = $request->note;
        $reqverified->user_id = $request->user_id;

        if (!isset($request->image)) {

            Storage::delete('public/uploads/request_verifieds/' . $reqverified->image);
            $reqverified->image = NULL;
           
      
          } else {
      
            if ($request->hasFile('image')) {
      
              if (isset($reqverified->image)) {
                Storage::delete('public/uploads/request_verifieds/' . $reqverified->image);
              }
      
              $image = $request->file('image');
              $imageName = time() . '_' . $image->getClientOriginalName();
              $photo = $image->storeAs('public/uploads/request_verifieds', $imageName);
              $reqverified->image = $imageName;
      
            }
      
        }

        $reqverified->save();

        return response()->json(
            [
                "message" => "Berhasil menambahkan request verified",
                "request_verified" => $reqverified
            ],
            201
        );
    }

    public function update(Request $request, $id)
    {
        $reqverified = RequestVerified::with('user')->find($id);
        
        $reqverified->note = $request->note;
        $reqverified->user_id = $request->user_id;

        if (!isset($request->image)) {

            Storage::delete('public/uploads/request_verifieds/' . $reqverified->image);
            $reqverified->image = NULL;
           
      
          } else {
      
            if ($request->hasFile('image')) {
      
              if (isset($reqverified->image)) {
                Storage::delete('public/uploads/request_verifieds/' . $reqverified->image);
              }
      
              $image = $request->file('image');
              $imageName = time() . '_' . $image->getClientOriginalName();
              $photo = $image->storeAs('public/uploads/request_verifieds', $imageName);
              $reqverified->image = $imageName;
      
            }
      
        }

        $reqverified->save();

        return response()->json(
            [
                "message" => "Berhasil update request verified",
                "request_verified" => $reqverified
            ],
            201
        );
    }

    public function destroy($id)
    {
        $reqverified = RequestVerified::with('user')->find($id);
        $reqverified->delete();

        return response()->json(
            [
                "message" => "Berhasil hapus request verified",
                "request_verified" => $reqverified
            ],
            200
        );
    }
}
