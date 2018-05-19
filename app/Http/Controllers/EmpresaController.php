<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Cidade;
use App\Models\Empresa;
use App\Models\EmpresaAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
{
    public function cadastrar(Request $request){

        $request->cd_cnpj = str_replace(['.', '/', '-'], '', $request->cd_cnpj);
        /*$this->validate($request, [
            'cd_cnpj' => 'required|numeric|max:14|unique',
            'ds_razao_social' => 'required|alpha|max:45',
        ]);*/

	    if (auth()->guard('empresa')->check()) {
	        Empresa::create([
            'cd_cnpj' =>  $request->cd_cnpj, 
            'ds_razao_social' => $request->rz_social, 
            'fk_usuario' =>  auth()->guard('empresa')->user()->id
        ]);
	         return redirect('painel/empresa/dashboard')->withInput($request->only('cd_cnpj'));
	    }  
	}

    public function editar(){
        $id = auth()->guard('empresa')->user()->id;
        $usuario = EmpresaAuth::find($id);
        $empresa = Empresa::where('fk_usuario', $id)->first();
        return view('area-empresa.dados-cadastrais.form')
        ->with('cidades',Cidade::all())
        ->with('usuario',$usuario)
        ->with('empresa',$empresa);
    }
    public function altera(){
        $id = auth()->guard('empresa')->user()->id;
        $paramsEmpresa = $this->getParamsEmpresa();
        $paramsUser = $this->getParamsUser();
        Empresa::where('fk_usuario', $id)->update($paramsEmpresa);
        EmpresaAuth::where('id', $id)->update($paramsUser);
        return redirect()->action('EmpresaController@editar');
    }
    public function getParamsEmpresa(Request $request){
        $request->cd_cnpj = str_replace(['.', '/', '-'], '', $request->cd_cnpj);
        /*$this->validate($request, [
            'cd_cnpj' => 'required|num|max:14|unique',
            'ds_razao_social' => 'required|alpha|max:45',
        ]);*/
        //'bairro' => 'required|regex:/(^[A-Za-z0-9 \' ã á â é ê í î õ ó ô ú û ç Ã Á Â Ê É Í Î Õ Ô Ó Ú Û Ç º ° ]+$)+/|max:45',

        $params = [
            'cd_cnpj' =>  $request->cd_cnpj, 
            'ds_razao_social' => $request->rz_social, 
            'fk_usuario' =>  auth()->guard('empresa')->user()->id            
        ];
        return $params;
    }
    public function getParamsUser(){
        //$request = Request::all();
        
        $params = [
            'name' => Request::input('nome'),
            'email' => Request::input('email'),
            'ds_rua' => Request::input('rua'),
            'nr_endereco' => Request::input('nr-endereco'),
            'ds_bairro' => Request::input('bairro'),
            'ds_complemento' => Request::input('complemento'),
            'nr_tel' => Request::input('tel'),
            'nr_cel' => Request::input('celular'),
            'im_perfil' => Request::input('foto'),
            'link_linkedin' => Request::input('linkedin'),
            'link_facebook' => Request::input('facebook'),
            'link_twitter' => Request::input('twitter'),
            'link_site' => Request::input('site'),
            'fk_cidade' => Request::input('cidade'),         
        ];

        /*if( !empty(Request::input('senha')) && !empty(Request::input('confirma-senha')) ){ 
            if ( Request::input('senha') == Request::input('confirma-senha') ){
                $senha = ['password' => Hash::make(Request::input('password')) ];
                $params = array_merge($params , $senha);
                print_r($params);
            }
        }*/
        return $params;
    }

    public function showRegistrationInfoForm()
    {
        return view('empresa-auth.info');
    }
}


