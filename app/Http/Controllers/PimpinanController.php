<?php

namespace App\Http\Controllers;

use App\Models\Fitur;
use App\Models\Programmer;
use App\Models\Project;
use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    public function showon(){
        return view('pimpinan.showon',[
            'projects' => Project::where('status',"on going")->get()
        ]
        );
    }

    public function project($id){
        return view('pimpinan.detailshowon',[
            'fiturs' => Fitur::where('project_id',"$id")->get(),
            'projects' => Project::where('id',"$id")->get(),
            'programmer' => Programmer::where('project_id',"$id")->get()
        ]
        );
    }

    public function showfinish(){
        return view('pimpinan.projectshowfinish',[
            'projects2' => Project::where('status',"finish")
                            ->orwhere('status',"waiting")
                            ->get()
        ]
        );
    }

    public function view($id){
        $project_id = Fitur::find($id);
        return view('pimpinan.fiturdetail',[
            'fiturs' => Fitur::where('id',"$id")->get(),
            'projects' => Project::where('id',"$project_id->project_id")->get(),
        ]
        );
    }
}
