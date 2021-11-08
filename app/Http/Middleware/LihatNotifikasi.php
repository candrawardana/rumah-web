<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Notifikasi;
use Auth;

class LihatNotifikasi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->has("lihat_notifikasi_id")){
            $Notifikasi = Notifikasi::where("id",$request->lihat_notifikasi_id)->where("user_id",Auth::id())->first();
            if($Notifikasi){
                if($Notifikasi->dilihat!=1){
                    $Notifikasi->dilihat=1;
                    $Notifikasi->save();
                }
                if($Notifikasi->jenis=="url"){
                    if (! $request->expectsJson()) {
                        return redirect()->to($Notifikasi->related_id);
                    }
                    else{
                        return response()->json(['result' => 'notification', 
                            'title' => $Notifikasi->judul,
                            'data'=>$Notifikasi->related_id
                        ]);
                    }
                }
            }
        }
        return $next($request);
    }
}
