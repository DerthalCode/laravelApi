<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Comment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\CompaniesResource;

class CompanyController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except'=>['index', 'showCompany', 'companies', 'company']]);
    }

    public function index(){
        $companies = Company::paginate(6);
        //dd($companies);
        return view('pages.home',compact('companies'));
    }

    public function addCompany(){
        return view('pages.add-company');

    }
    public function storeCompany(Request $request){

        //dd(request()->all());
        
        $validated = $request->validate([
            'company' => 'required|unique:companies|max:255',
            'code'=>'required',
            'logo'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if(request()->hasFile('logo')){
            $path = $request->file('logo')->store('public/image');
            $fileName = str_replace('public/','',$path);
        }else{
            $fileName = NULL;
        }
        // dd(request()->all());
        // dd(Auth::id());
        Company::create([
            'company'=>request('company'),
            'code'=>request('code'),
            'vat'=>request('vat'),
            'address'=>request('address'),
            'director'=>request('director'),
            'description'=>request('description'),
            'logo'=>$fileName,
            'user_id'=>Auth::id()
        ]);
        return redirect('/');
    }

    public function showCompany (Company $company){

        $comments = Comment::where('company_id',$company->id)->get();

        //dd($comments);

        return view('pages.show-company', compact('company','comments'));
    }

    public function deleteCompany(Company $company){
        if(Gate::denies('delete-company', $company)){
            dd('Tu nerturi teises! Bet zinau kur gaut...');
        }
        $company->delete();
        return redirect('/');
    }

    public function updateCompany(Company $company){
        if(Gate::denies('edit-company', $company)){
            dd('Tu nerturi teises! Bet zinau kur galima gaut...');
        }
        return view('pages.edit-company', compact('company'));
    }

    public function storeUpdate(Company $company, Request $request){
        if($company->logo){
            File::delete(storage_path('app/public/'.$company->logo));
        }

        if(request()->hasFile('logo')){
            $path = $request->file('logo')->store('public/image');
            $fileName = str_replace('public/','',$path);
            Company::where('id',$company->id)->update(['logo'=>$fileName]);
        }

        Company::where('id', $company->id)->update($request->only(['company','code','vat','address','director','description']));
        return redirect('/company/'.$company->id);
    }

  

    public function processImport(Request $request){
        $path = $request->file('data')->store('public/data'); //issaugoja ir nurodo kelia
        $File = Storage::get($path); //paima faila
        $File = explode(PHP_EOL,$File); // pavercia csv i masyva
        $data = []; 

        foreach($File as $k => $v ) 
        {
            $data[$k] = explode(';', $v);
        }
        // dd($data);
        // $File = explode(';', $File);
        
        return view('pages.checkImport', compact('data'));

    }

    public function importCompany(){
        return view('pages.import-company');
    }

    public function storeImport(Request $request)
    {
        //$data = unserialize($_POST['data']);
        $data=[];
        foreach($_POST['data'] as $k => $v)
        {
            $data[$k] = json_decode($v);
        }   
        //dd($data);


         foreach($data as $k => $v ){
             DB::table('companies')->insert(['company' => $v[0], 'code' => $v[1], 'vat' => $v[2], 'address' => $v[3], 'director' => $v[4], 'description' => $v[5], 'logo' => $v[6]]);
         }

       return redirect('/');
    }

    public function companies(){
        $companies=Company::all();
        return CompaniesResource::collection($companies);
    }

    public function company(Company $company){
        
        return new CompaniesResource($company);
    }
}
