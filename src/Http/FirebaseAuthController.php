<?php

namespace Kkcodes\FirebaseAuth\Http;

use App\Http\Controllers\Auth\LoginController;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Kkcodes\FirebaseAuth\FirebaseUser;
use Kkcodes\FirebaseAuth\FirebaseSigninSource;

class FirebaseAuthController extends LoginController
{

    public function loginFirebase()
    {

        if(!empty(Auth::check()))
        {

            return redirect($this->redirectTo);

        }

        $data = Input::get();

        if(!empty($data)) {


            $signInId = trim($data["sign_in_id"]);

            $check = $this->checkExisting($signInId);

            if (!empty($check->user_id)) {

                $id = $check->user_id;

            } else {

                $source = $data["source"];

                $sourceArr = explode(".", $source);

                $sourceId = FirebaseSigninSource::where('name','LIKE','%'.$sourceArr[0].'%')
                    ->where([
                    "active" => 1
                ])->first(['id']);

                if(!empty($sourceId->id))
                {
                    $sourceId = $sourceId->id;

                }
                else
                {

                    return ["status" => 0];

                }

                $id = User::insertGetId([
                    "name" => $data["name"],
                    "email" => $data["email"],
                    "password" => bcrypt($signInId),
                    "created_at" => Carbon::now()
                ]);

                FirebaseUser::insert([
                    "user_id" => $id,
                    "sign_in_id" => $signInId,
                    "source_id" => $sourceId,
                    "pic" => $data["pic"],
                    "active" => 1,
                    "created_at" => Carbon::now()
                ]);

            }

            printf(Auth::check());

            Auth::loginUsingId($id);

            return ["status" => 1];

        }

        $source = FirebaseSigninSource::where('active',1)->pluck('name')->toArray();

        $finalsrc = ["src" => $source];

        $data = [
            "redirectTo" => $this->redirectTo,
            "apiKey" => env('FIREBASE_AUTH_API_KEY'),
            "authDomain" => env('FIREBASE_AUTH_DOMAIN'),
            "db" => env('FIREBASE_DB_URL'),
            "source" => json_encode($finalsrc),
            "projectId" => env('FIREBASE_PROJET_ID'),
            "bucket" => env('FIREBASE_STORAGE_BUCKET'),
            "senderId" => env('FIREBASE_SENDER_ID')
        ];

        return view('fireview::auth_login')->with([
                "data" => $data
        ]);
    }

    private function checkExisting($signInId)
    {

        return  FirebaseUser::where([
            "sign_in_id" => $signInId,
            "active" => 1
        ])->first(['user_id']);

    }
}