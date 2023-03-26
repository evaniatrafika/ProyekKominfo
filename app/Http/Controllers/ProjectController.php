<?php

namespace App\Http\Controllers;

use App\Models\Fitur;
use App\Models\History;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Programmer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class ProjectController extends Controller
{
    public function store(Request $request){
        $validateData = $request->validate([
             'opsi' => 'required',
             'project' => 'min:0',
             'nama_project' => 'required|unique:projects',
             'jenis' => 'required',
             'deskripsi' => 'required',
             'persentase' => 'required',
             'pengaju' => 'required',
             'target' => 'required|date',
             'mulai' => 'required|date|after:yesterday',
             'penginput' => 'required',
             'status' => 'required'
         ]);
         Project::create($validateData);

         //simpan data history (log data)
        History::create([
            'nama_user'     => auth()->user()->name,
            'nama_project'  => $request['nama_project'],
            'aktivitas'     => 'Membuat Project "'.$request['nama_project'].'"' ,
            'role'          => auth()->user()->role
        ]);

          return redirect()->back()->with('success', 'Project Successfully Created!!');
     }
     public function addprog(Request $request){

        $validateData = $request->validate([
            'user_id' => ['required', Rule::unique('programmers')
            ->where('project_id', $request->project_id)],
            'project_id' => 'required'
        ]);
        Programmer::create($validateData);
        return redirect()->back()->with('success', 'Programmer Successfully Created!!');
     }
     public function destroy($id){
        $post   = Programmer::find($id);
        $post->delete();
         return redirect()->back()->with('success', 'Programmer has been deleted!!');
    }
    public function addfit(Request $request){
        $this->validate($request , [
            'user_id' => 'required',
            'project_id' => 'required',
            'nama_fitur' => ['required', 'max:255',Rule::unique('fiturs')
                ->where('project_id', $request->project_id)],
            'nama_file' => 'mimes:doc,docx,pdf,xls,xlsx,pdf,ppt,pptx'
        ]);

        if($request->file('nama_file')){
            $dokumen       = $request->file('nama_file');
            $name_dokumen  = 'MP'.date('Ymdhis').'.'.$request->file('nama_file')->
            getClientOriginalExtension();
            $dokumen->move('post-dokumen/', $name_dokumen);
        }

        $data = new Fitur();
        $data->user_id = $request->user_id;
        $data->project_id = $request->project_id;
        $data->nama_fitur = $request->nama_fitur;
        $data->nama_file = $name_dokumen;
        $data->save();
        return redirect()->back()->with('success', 'Fitur Successfully Created!!');
     }
     public function destroyfit($id){
        $post   = Fitur::find($id);
        $post->delete();
         return redirect()->back()->with('success', 'Fitur has been deleteed!!');
    }
    public function edit($id){
        $project  = Project::whereId($id)->first();
        return redirect()->back()->with('projects', $project);
    }
    public function update(Request $request, $id){
        $Project           = Project::find($id);

        //log history edit project
        History::create([
            'nama_user'     => auth()->user()->name,
            'nama_project'  => $Project->nama_project,
            'aktivitas'     => 'Mengedit Project "'.$request['nama_project'].'"' ,
            'role'          => auth()->user()->role
        ]);

        $Project->opsi    = $request['opsi'];
        $Project->project  = $request['project'];
        $Project->nama_project  = $request['nama_project'];
        $Project->jenis    = $request['jenis'];
        $Project->deskripsi = $request['deskripsi'];
        $Project->pengaju    = $request['pengaju'];
        $Project->target  = $request['target'];
        $Project->mulai    = $request['mulai'];
        $Project->penginput = $request['penginput'];
        $Project->status = $request['status'];

        $Project->save();


        return redirect()->back()->with('success', 'Project has been updated!!');
    }

    public function verifikasi(Request $request, $id){
        $project           = Project::find($id);
        $project->status   = $request['status'];
        $project->save();

        return view('koordinator.projecton',[
           'projects' => Project::where('status',"on going")->get(),
           'projects2' => Project::where('status',"finish")->get()
       ]
        )->with('success', 'Project Has Been Verified!!');
       }

    public function history(){
        if(auth()->user()->role === "programmer"){
            $history= History::orderBy('created_at','DESC')->get();
            return view('programmer.activity')->with('history', $history);

        }elseif(auth()->user()->role === "koordinator"){
            $history= History::orderBy('created_at','DESC')->get();
            return view('koordinator.activity')->with('history', $history);

        }elseif(auth()->user()->role === "BPA"){
            $history= History::orderBy('created_at','DESC')->get();
            return view('koordinator.activity')->with('history', $history);

        }elseif(auth()->user()->role === "pimpinan"){
            $history= History::orderBy('created_at','DESC')->get();
            return view('pimpinan.activity')->with('history', $history);
        }
    }

    public function destroyproject($id){
        $post   = Project::find($id);

        //log history edit project
        History::create([
            'nama_user'     => auth()->user()->name,
            'nama_project'  => $post->nama_project,
            'aktivitas'     => 'Menghapus Project "'.$post->nama_project.'"' ,
            'role'          => auth()->user()->role
        ]);

        $post->delete();

         return redirect()->back()->with('success', 'Project has been deleteed!!');
    }

}
