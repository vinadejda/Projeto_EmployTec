@extends('area-empresa.layout.template')

@section('content')

  @if(count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <div class="container-fluid caixa-vagas ">
    <div class="card-body">

      @if(isset($usuario) && isset($empresa))

        <form role="form" method="post" action="/painel/empresa/alterar/">
          @csrf
          <p >Campos com <span class="text-danger">*</span> são de preenchimento obrigatório</p>
          <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
          <input type="hidden" input type="text" name="user" class="form-control" value="{{$empresa->fk_usuario}}">
           <fieldset>
              <legend>Dados de Login</legend>

              <div class="form-group col-md-6">
                <label for="nome">
                  <span class="text-danger">*</span> Nome
                </label>
                <input type="text" name="nome" class="form-control" pattern="[A-Za-z\s]+$" title="Nome digitado em formato invalido." maxlength="45" placeholder="Nome da Empresa" value="{{$usuario->name}}" required>
              </div>
              
              <div class="form-group col-md-6">
                <label for="email">
                  <span class="text-danger">*</span> Email
                </label>
                <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Email digitado de maneira encorreta." maxlength="45" class="form-control" placeholder="Email da Empresa"  value="{{$usuario->email}}" required>
              </div>
              <!--
              <div class="form-group col-md-6">
                <label for="senha">Senha</label>
                <input type="password" name="senha" class="form-control" placeholder="Digite a nova senha">
              </div>
              <div class="form-group col-md-6">
                <label for="confirma-senha">Confirmar Senha</label>
                <input type="password" name="confirma-senha" class="form-control" placeholder="Digite novamente a nova senha">
              </div>
            -->

              <div class="form-group col-md-12">
                <label for="foto">Foto</label>
                <input type="file" name="foto" maxlength="250" value="{{$usuario->im_perfil}}">
              </div>
            </fieldset>
            <br>
            <fieldset>
              <legend>Dados da Empresa</legend>

              <div class="form-group col-md-4">
                <label for="cnpj">
                  <span class="text-danger">*</span> CNPJ
                </label>
                <input type="text" name="cnpj" pattern="[0-9]+$" title="CNPJ digitado em formato invalido." maxlength="14" class="form-control" placeholder="CNPJ" value="{{$empresa->cd_cnpj}}" readonly required>
              </div>

              <div class="form-group col-md-8">
                <label for="rz_social">
                  <span class="text-danger">*</span> Razão Social
                </label>
                <input type="text" name="rz_social" pattern="[A-Za-z\s]+$" title="Razão Social digitado em formato invalido." maxlength="30" class="form-control" placeholder="Digite a Razão Social"  value="{{$empresa->ds_razao_social}}" required>
              </div>

              <div class="form-group col-md-6">
                <label for="rua">
                  <span class="text-danger">*</span> Rua
                </label>
                <input type="text" name="rua"  pattern="[A-Za-z0-9\s]+$" title="Endereço digitado de forma encorreta" maxlength="45" class="form-control" placeholder="Digite o endereço"  value="{{$usuario->ds_rua}}" required>
              </div>

              <div class="form-group col-md-3">
                <label for="nr-endereco">
                  <span class="text-danger">*</span> nº
                </label>
                <input type="text" name="nr-endereco" pattern="[0-9]+$" title="Número da residecia digitado de forma encorreta" maxlength="5" class="form-control" placeholder="Digite o número do endereço" value="{{$usuario->nr_endereco}}" required>
              </div>

              <div class="form-group col-md-3">
                <label for="complemento">Complemento</label>
                <input type="text" name="complemento" pattern="[A-Za-z\s]+$" title="Complemento digitado de forma encorreta" maxlength="50" class="form-control" placeholder="Digite o complemento"  value="{{$usuario->ds_complemento}}">
              </div>

              <div class="form-group col-md-3">
                <label for="bairro">
                  <span class="text-danger">*</span> Bairro
                </label>
                <input type="text" name="bairro" pattern="[A-Za-z\s]+$" title="Bairro digitado em formato invalido." maxlength="45" class="form-control" placeholder="Digite o bairro"  value="{{$usuario->ds_bairro}}" required>
              </div>
        
              <div class="form-group col-md-3">
                <label for="cidade">Cidade</label>
                <select id="cidade" name="cidade" class="form-control" >
                  <option {{(isset($usuario) ? '' : 'selected="selected"')}}></option>
                  @if(isset($cidades))
                    @foreach($cidades as $c)
                      <option value="{{$c->cd_cidade}}" {{(isset($usuario) && $c->cd_cidade == $usuario->fk_cidade) ? 'selected="selected"' : ''}}>{{$c->nm_cidade}}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="tel">Telefone</label>
                <input type="tel" name="tel" maxlength="11" pattern="\([0-9]{2}\) [0-9]{4,4}-[0-9]{3,4}+$" class="form-control" placeholder="Digite o telefone" value="{{$usuario->nr_tel}}">
              </div>

              <div class="form-group col-md-3">
                <label for="celular">Celular</label>
                <input type="tel" name="celular"  maxlength="11" pattern="\([0-9]{2}\) [0-9]{4,6}-[0-9]{3,4}+$" class="form-control" placeholder="Digite o celular" value="{{$usuario->nr_cel}}">
              </div>
            </fieldset>
            <br>
            <fieldset>
              <legend>Redes Sociais</legend>

              <div class="form-group col-md-3">
                <label for="linkedin">Linkedin</label>
                <input type="url" name="linkedin" maxlength="45" class="form-control" placeholder="Digite o Linkedin" value="{{$usuario->link_linkedin}}">
              </div>

              <div class="form-group col-md-3">
                <label for="facebook">Facebook</label>
                <input type="url" name="facebook" maxlength="45" class="form-control" placeholder="Digite o Facebook" value="{{$usuario->link_facebook}}">
              </div>

              <div class="form-group col-md-3">
                <label for="twitter">Twitter</label>
                <input type="url" name="twitter" maxlength="45" class="form-control" placeholder="Digite o Twitter" value="{{$usuario->link_twitter}}">
              </div>

              <div class="form-group col-md-3">
                <label for="site">Site</label>
                <input type="url" name="site" maxlength="45" class="form-control" placeholder="Digite o Site" 
                value="{{$usuario->link_site}}">
              </div>
            </fieldset>
            <br>
            <div class="form-group col-md-8">
              <button type="submit" class="btn btn-success" >Salvar Dados</button>
              <button type="reset" class="btn btn-primary">Desfazer Mudanças</button>
              <!--<input type="button" class="btn btn-danger" value="Voltar" onClick="history.go(-1)"> -->
            </div>
          </form> 
        @endif
      </div> 
  
  </div>

@endsection