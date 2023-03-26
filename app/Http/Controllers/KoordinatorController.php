<?php

namespace App\Http\Controllers;

use App\Models\Fitur;
use App\Models\Project;
use App\Models\User;
use App\Models\Programmer;
use Illuminate\Http\Request;

class KoordinatorController extends Controller
{
    public function index(){
        return view('koordinator.listkoordinator',[
            'users' => User::where('role',"koordinator")->get()
        ]
        );
    }
    public function index2(){
        return view('koordinator.listpimpinan',[
            'users' => User::where('role',"pimpinan")->get()
        ]
        );
    }
    public function index3(){
        return view('koordinator.listprogrammer',[
            'users' => User::where('role',"programmer")->get()
        ]
        );
    }
    public function index4(){
        return view('koordinator.listbpa',[
            'users' => User::where('role',"BPA")->get()
        ]
        );
    }
    public function viewproject(){
        return view('koordinator.projectpage',[
            'projects' => Project::where('status',"verifikasi")->get(),
            'projects2' => Project::where('status',"finish")->get()
        ]
        );
    }
    public function show($id){
        $project   = Project::whereId($id)->first();
        $users = User::where('role',"programmer")->get();
        $programmer = Programmer::where('project_id',"$id")->get();
        $fitur = Fitur::where('project_id',"$id")->get();
        return view('koordinator.detailverifikasi', compact('users'))->with('projects', $project)->with('programmers', $programmer)
                                                                     ->with('fiturs', $fitur) ;
}

public function showongoing($id){
    $project   = Project::whereId($id)->first();
    $users = User::where('role',"programmer")->get();
    $programmer = Programmer::where('project_id',"$id")->get();
    $fitur = Fitur::where('project_id',"$id")->get();
    return view('koordinator.detailongoing', compact('users'))->with('projects', $project)->with('programmers', $programmer)
                                                                 ->with('fiturs', $fitur) ;
}

public function showon(){
    return view('koordinator.projecton',[
        'projects' => Project::where('status',"on going")->get()
    ]
    );
}

public function showfinish(){
    return view('koordinator.projectfinish',[
        'projects' => Project::where('status',"waiting")->get(),
        'projects2' => Project::where('status',"finish")->get()
    ]
    );
}

public function acc($id){
    //Tambah Jumlah Kinerja Programmer
    $finish = Programmer::where('project_id',$id)->get();
    foreach ($finish as $finish) {
        $tambah = User::find($finish->user_id);
        $tambah->jumlah_kinerja = $tambah->jumlah_kinerja + 1;
        $tambah->save();
    }

    //ganti status project ke finish
    $project = Project::find($id);
    $project->status = "finish";
    $project->save();
    
     return redirect()->back()->with('success', 'Project Dikonfirmasi Telah Selesai');
}

public function project($id){
    return view('koordinator.detailproject',[
        'fiturs' => Fitur::where('project_id',"$id")->get(),
        'projects' => Project::where('id',"$id")->get(),
        'programmer' => Programmer::where('project_id',"$id")->get()
    ]
    );
}

public function view($id){
    $project_id = Fitur::find($id);

    return view('koordinator.progresview',[
        'fiturs' => Fitur::where('id',"$id")->get(),
        'projects' => Project::where('id',"$project_id->project_id")->get(),
    ]
    );
}

}
