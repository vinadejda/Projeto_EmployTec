@extends('area-empresa.layout.template')

@section('content')
<!--
  @if(count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
  @endif
-->
  <section class="container-fluid caixa-vagas ">
  
        <form role="form" method="post" 
        action="{{isset($perfil) ? '/painel/empresa/perfil/altera': '/painel/empresa/perfil/adiciona'}}">
          <fieldset>
            <p >Campos com <span class="text-danger">*</span> são de preenchimento obrigatorio</p>
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <input type="hidden" input type="text" name="id" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" value="{{isset($perfil) ? $perfil->cd_perfil_vaga : '' }}">

            <div class="form-group col-md-6">
              <label for="nome">
                <span class="text-danger">*</span> Nome
              </label>
              <input type="text" name="nome"  maxlength="20" pattern="[a-zA-Z\s\']+" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" placeholder="Nome do perfil" required value="{{isset($perfil) ? $perfil->nm_perfil_vaga : old('nome')}}">
              @if ($errors->has('nome'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('nome') }}</strong>
                  </span>
                @endif
            </div>

            <div class="form-group col-md-6">
              <label for="vaga">
                <span class="text-danger">* </span> Vaga
              </label>
              <select id="vaga" name="vaga" maxlength="20" pattern="[a-zA-Z\s\']+" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" required>
              	<option {{(isset($perfil) ? '' : 'selected')}}></option>
                @foreach($vagas as $v)
                  <option value="{{$v->cd_vaga}}" {{(isset($perfil) && $v->cd_vaga == $id_vaga) ? 'selected' : ''}}>{{$v->nm_vaga}}</option>
                @endforeach
              </select>
              @if ($errors->has('nome'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('nome') }}</strong>
                  </span>
                @endif
            </div>

            <div class="form-group col-md-4">
              <label for="genero">
                <span class="text-danger">*</span> Gênero
              </label><br>
              <label for="male">
              	<input type="radio" id="male" name="genero" value="Masculino" required
              {{(isset($perfil) && 'Masculino' == $perfil->ds_genero) ? 'checked' : ''}} > Masculino
          	</label>
			 <label for="female">
			  <input type="radio" id="female" name="genero" value="Feminino"
			  {{(isset($perfil) && 'Feminino' == $perfil->ds_genero) ? 'checked' : ''}}> Feminino
			  </label>
			  <label for="other">
			  <input type="radio" id="other" name="genero" value="Outros"
			  {{(isset($perfil) && 'Outros' == $perfil->ds_genero) ? 'checked' : ''}}> Outros
			  </label>
      </div>

            <div class="form-group col-md-3">
              <label for="idade">
                <span class="text-danger">*</span> Idade
              </label>
              <input type="number" name="idade"  class="form-control{{ $errors->has('idade') ? ' is-invalid' : '' }}" placeholder="Digite a idade desejada" required min="14" max="90" value="{{isset($perfil) ? $perfil->nr_idade : old('idade')}}">
              @if ($errors->has('idade'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('idade') }}</strong>
                  </span>
                @endif
            </div>

            <div class="form-group col-md-5">
              <label for="formacao">
                <span class="text-danger">* </span> Formação
              </label>
              <input type="text" name="formacao" maxlength="45" pattern="[a-zA-Z\s\']+" class="form-control{{ $errors->has('formacao') ? ' is-invalid' : '' }}" placeholder="Digite a formação desejada" required="required" value="{{isset($perfil) ? $perfil->ds_formacao : old('formacao')}}">
              @if ($errors->has('formacao'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('formacao') }}</strong>
                  </span>
                @endif
              <!--<select id="formacao" name="areaTI" class="form-control" required="required">
                <option {{(isset($perfil) ? '' : 'selected="selected"')}}></option>
                <option value="Cursando curso técnico" {{(isset($perfil) && 'Cursando curso técnico' == $perfil->ds_formacao) ? 'selected="selected"' : ''}}>Estágio</option>
                <option value="Graduando" {{(isset($perfil) && 'Estágio' == $perfil->ds_formacao) ? 'selected="selected"' : ''}}>Estágio</option>
                <option value="Trainne" {{(isset($perfil) && 'Trainne' == $perfil->ds_formacao) ? 'selected="selected"' : ''}}>Trainne</option>
              </select>
          	-->
            </div>
            <!--div class="form-group col-md-12">
              <label for="competencia">Competências</label>
              <textarea name="competencia" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}"  rows="2" >{{isset($perfil) ? $perfil->ds_interresse : old('competencia')}}</textarea>
              @if ($errors->has('competencia'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('competencia') }}</strong>
                  </span>
                @endif
            </div-->
          </fieldset>
          <div class="form-group col-md-8">
            <button type="submit" class="btn btn-success" >Salvar Dados</button>
            @if(!isset($perfil))
              <button type="reset" class="btn btn-primary">Limpar</button>
            @endif
          </div>
        </form>     
  
  </section>

@endsection