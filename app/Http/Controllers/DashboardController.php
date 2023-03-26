<?php

namespace App\Http\Controllers;

use App\Models\Fitur;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function koor(){
        //count project total
        $countprojectselesai = Project::all();
        $projecttotal = $countprojectselesai->count();
        //count project selesai
        $countprojectdone = Project::where('status','finish')->get();
        $projectselesai = $countprojectdone->count();
        //count project proses
        $countprojectproses = Project::where('status','on going')
                                ->orwhere('status','waiting')
                                ->get();
        $projectproses = $countprojectproses->count();
        //persentase proses
        if($projectproses == 0){
            $persentaseproses = 0;
        }else{
            $persentaseproses =  $projectproses / $projecttotal * 100;
        }
        $persentaseproses = substr($persentaseproses,0,5);
        //persentase selesai
        if($projectselesai == 0){
            $persentaseselesai = 0;
        }else{
            $persentaseselesai =  $projectselesai / $projecttotal * 100;
        }
        $persentaseselesai = substr($persentaseselesai,0,5);
        //count project waiting
        $project_waiting = Project::where('status','waiting')
                             ->get();
        $project_waiting = $project_waiting->count();
        return view('koordinator/dashboard',[
           'project_total' => $projecttotal,
           'project_selesai' => $projectselesai,
           'project_proses' => $projectproses,
           'persentase_proses' => $persentaseproses,
           'persentase_selesai' => $persentaseselesai,
           'project_waiting' => $project_waiting
        ]
    );
       }

    public function prog(){
        //count project total
        $countprojectselesai = DB::table('programmers')
                                ->leftjoin('projects', 'programmers.project_id','=','projects.id')
                                ->where('programmers.user_id',auth()->user()->id)
                                ->get();
        $projecttotal = $countprojectselesai->count();
        //count project selesai
        $countprojectdone = DB::table('projects')
                            ->leftJoin('programmers', 'projects.id', '=', 'programmers.project_id')
                            ->where(function ($query) {
                                $query->where('projects.status', '=', 'waiting')
                                    ->orWhere('projects.status', '=', 'finish');
                            })
                            ->where('programmers.user_id', '=', auth()->user()->id)
                            ->orderBy('projects.created_at', 'DESC')
                            ->get();
        $projectselesai = $countprojectdone->count();
        //count project proses
        $countprojectproses = DB::table('programmers')
                                ->leftjoin('projects', 'programmers.project_id','=','projects.id')
                                ->where('projects.status',"on going")
                                ->where('programmers.user_id',auth()->user()->id)
                                ->get();
        $projectproses = $countprojectproses->count();
                //persentase proses
                if($projectproses == 0){
                    $persentaseproses = 0;
                }else{
                    $persentaseproses =  $projectproses / $projecttotal * 100;
                }
                $persentaseproses = substr($persentaseproses,0,5);
                //persentase selesai
                if($projectselesai == 0){
                    $persentaseselesai = 0;
                }else{
                    $persentaseselesai =  $projectselesai / $projecttotal * 100;
                }
                $persentaseselesai = substr($persentaseselesai,0,5);
        return view('programmer/dashboard',[
           'project_total' => $projecttotal,
           'project_selesai' => $projectselesai,
           'project_proses' => $projectproses,
           'persentase_proses' => $persentaseproses,
           'persentase_selesai' => $persentaseselesai,
           'jumlah_kinerja' => auth()->user()->jumlah_kinerja
        ]
    );
    }

    public function BPA(){
       //count project total
       $countprojectselesai = Project::all();
       $projecttotal = $countprojectselesai->count();
       //count project selesai
       $countprojectdone = Project::where('status','finish')->get();
       $projectselesai = $countprojectdone->count();
       //count project proses
       $countprojectproses = Project::where('status','on going')
                               ->orwhere('status','waiting')
                               ->get();
       $projectproses = $countprojectproses->count();
       //persentase proses
       if($projectproses == 0){
           $persentaseproses = 0;
       }else{
           $persentaseproses =  $projectproses / $projecttotal * 100;
       }
       $persentaseproses = substr($persentaseproses,0,5);
       //persentase selesai
       if($projectselesai == 0){
           $persentaseselesai = 0;
       }else{
           $persentaseselesai =  $projectselesai / $projecttotal * 100;
       }
       $persentaseselesai = substr($persentaseselesai,0,5);
       //count project waiting
       $project_waiting = Project::where('status','waiting')
                            ->get();
       $project_waiting = $project_waiting->count();
       return view('koordinator/dashboard',[
          'project_total' => $projecttotal,
          'project_selesai' => $projectselesai,
          'project_proses' => $projectproses,
          'persentase_proses' => $persentaseproses,
          'persentase_selesai' => $persentaseselesai,
          'project_waiting' => $project_waiting
       ]
   );
      }

    public function pimpinan(){
       //count project total
       $countprojectselesai = Project::all();
       $projecttotal = $countprojectselesai->count();
       //count project selesai
       $countprojectdone = Project::where('status','finish')->get();
       $projectselesai = $countprojectdone->count();
       //count project proses
       $countprojectproses = Project::where('status','on going')
                               ->orwhere('status','waiting')
                               ->get();
       $projectproses = $countprojectproses->count();
               //persentase proses
               if($projectproses == 0){
                $persentaseproses = 0;
            }else{
                $persentaseproses =  $projectproses / $projecttotal * 100;
            }
            $persentaseproses = substr($persentaseproses,0,5);
            //persentase selesai
            if($projectselesai == 0){
                $persentaseselesai = 0;
            }else{
                $persentaseselesai =  $projectselesai / $projecttotal * 100;
            }
            $persentaseselesai = substr($persentaseselesai,0,5);
       return view('pimpinan/dashboard',[
          'project_total' => $projecttotal,
          'project_selesai' => $projectselesai,
          'project_proses' => $projectproses,
          'persentase_proses' => $persentaseproses,
          'persentase_selesai' => $persentaseselesai
       ]
   );
      }

}
