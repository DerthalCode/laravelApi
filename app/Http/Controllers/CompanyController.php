<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
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
        Company::create([
            'company'=>request('company'),
            'code'=>request('code'),
            'vat'=>request('vat'),
            'address'=>request('address'),
            'director'=>request('director'),
            'description'=>request('description'),
            'logo'=>$fileName
        ]);
        return redirect('/');
    }

    public function showCompany (Company $company){

        return view('pages.show-company', compact('company'));
    }

    public function deleteCompany(Company $company){
        $company->delete();
        return redirect('/');
    }

    public function updateCompany(Company $company){
        
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

    public function importCompany(){
        return view('pages.import-company');
    }

    public function storeImport(Company $company, Request $request){
        if($company->logo){
            File::delete(storage_path('app/public/'.$company->logo));
        }
        Company::where('id', $company->id)->update($request->only(['company','code','vat','address','director','description']));
        return redirect('/company/'.$company->id);
    }

}
