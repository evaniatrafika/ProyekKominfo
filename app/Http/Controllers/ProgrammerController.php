<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fitur;
use App\Models\History;
use App\Models\Programmer;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PHPUnit\TextUI\XmlConfiguration\Group;

class ProgrammerController extends Controller
{
    public function progres(){
        return view('programmer.progres',[
            'projects' => DB::table('programmers')
                            ->leftjoin('projects', 'programmers.project_id','=','projects.id')
                            ->where('programmers.user_id',auth()->user()->id)
                            ->where('projects.status',"on going")
                            ->orderBy('projects.created_at','DESC')
                            ->get()
            // Project::where('status',"on going")->orderBy('created_at','DESC')->get()
        ],[
            'project_finish' => DB::table('programmers')
                            ->leftjoin('projects', 'programmers.project_id','=','projects.id')
                            ->where('programmers.user_id',auth()->user()->id)
                            ->where('projects.status',"on going")
                            ->where('projects.persentase','=',"100 %")
                            ->orderBy('projects.created_at','DESC')
                            ->get()
            // 'project_finish' => Project::where('status',"waiting")->get()
        ]
        );
    }

    public function detail($id){
        return view('programmer.detail',[
            'fiturs' => Fitur::where('project_id',"$id")->get(),
            'projects' => Project::where('id',"$id")->get(),
            'programmer' => Programmer::where('project_id',"$id")->get()
        ]
        );
    }

    public function update(Request $request, $id){
        $fitur           = Fitur::find($id);
        $fitur->status = "1";
        $fitur->keterangan   = $request['ket'];
        $fitur->link_git  = $request['linkgit'];
        $fitur->uploader = $request['user'];
        $fitur->tgl_update = date("Y/m/d h:i:s");

        //save image
        if($request['inputimg'] != null){
        $gambar      = $request->file('inputimg');
        $name_gambar  = 'GP'.date('Ymdhis').'.'.$request->file('inputimg')->
            getClientOriginalExtension();
        $gambar->move('img/', $name_gambar);
        $fitur->gambar  = $name_gambar;
    }
    $fitur->save();

        //fungsi menghitung persentase project
        $countselesai = Fitur::where('project_id',"$fitur->project_id")
                ->where('status', '=', "1")
                ->get();
        $fiturselesai = $countselesai->count();

        $countfitur = Fitur::where('project_id',"$fitur->project_id")
                ->get();
        $jumlahfitur = $countfitur->count();

$persentase = ($fiturselesai / $jumlahfitur) * 100;
$persentase = substr($persentase,0,5);
$persen = $persentase." %";
        // end of fungsi menghitung persentase project

        $project           = Project::find($fitur->project_id);
        $project->persentase = $persen;
        $project->save();

        //simpan data history (log data)
        $project = Project::find($fitur->project_id);
        History::create([
            'nama_user'     => auth()->user()->name,
            'nama_project'  => $project->nama_project,
            'aktivitas'     => 'Mengupdate Fitur "'.$fitur->nama_fitur.'"' ,
            'role'          => auth()->user()->role
        ]);

        return redirect()->back()->with('success', 'Progres Berhasil Diupdate!!');
    }

    public function  projectfinish(){
        return view('programmer.projectfinish', [
            'projects' => DB::table('projects')
                ->leftJoin('programmers', 'projects.id', '=', 'programmers.project_id')
                ->where(function ($query) {
                    $query->where('projects.status', '=', 'waiting')
                        ->orWhere('projects.status', '=', 'finish');
                })
                ->where('programmers.user_id', '=', auth()->user()->id)
                ->orderBy('projects.created_at', 'DESC')
                ->get()
        ]);
    }

    public function confirmfinish($id){
        return view('programmer.confirmfinish',[
            'fiturs' => Fitur::where('project_id',"$id")->get(),
            'projects' => Project::where('id',"$id")->get(),
            'programmer' => Programmer::where('project_id',"$id")->get()
        ]
        );
    }

    public function done($id){
        $fitur   = Fitur::find($id);
        $project = Project::find($fitur->project_id);
        $project->status = "waiting";
        $project->selesai = date("Y/m/d");
        $project->save();
         return view('programmer.projectfinish',[
                'projects' => DB::table('projects')
                    ->leftJoin('programmers', 'projects.id', '=', 'programmers.project_id')
                    ->where(function ($query) {
                        $query->where('projects.status', '=', 'waiting')
                            ->orWhere('projects.status', '=', 'finish');
                    })
                    ->where('programmers.user_id', '=', auth()->user()->id)
                    ->orderBy('projects.created_at', 'DESC')
                    ->get()
         ])->with('success', 'Project Diselesaikan, Menunggu Konfirmasi Koordinator / BPA');
    }

}
