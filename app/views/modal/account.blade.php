@extends('layouts.default')

@section('content')

  <div class="container">

    <div id="registration">
    
      <div class="twelve columns">
        <h1>Cadastro</h1>
        <p>Faça seu cadastro para poder compartilhar imagens no Arquigrafia.<br>
        <small>* Todos os campos a seguir são obrigatórios.</small>
        </p>
      </div>
      
      <div class="four columns">
      
        {{ Form::open(array('url' => 'users')) }}
          <div class="two columns alpha"><p>{{ Form::label('name', 'Nome*:') }}</p></div>
          <div class="two columns omega">
            <p>{{ Form::text('name') }} <br>
            <div class="error">{{ $errors->first('name') }} </div>
            </p>
          </div>
          
          
          <div class="two columns alpha"><p>{{ Form::label('login', 'Login*:') }}</p></div>
          <div class="two columns omega">
            <p>{{ Form::text('login') }} <br>
            <div class="error">{{ $errors->first('login') }}</div>
            </p>
          </div>
          
          <div class="two columns alpha"><p>{{ Form::label('email', 'E-mail*:') }}</p></div>
          <div class="two columns omega">
            <p>{{ Form::text('email') }}<br>
            <div class="error">{{ $errors->first('email') }}</div>
            </p>
          </div>
          
          <div class="two columns alpha"><p>{{ Form::label('password', 'Senha*:') }}</p></div>
          <div class="two columns omega">
            <p>{{ Form::password('password') }}<br>
            <div class="error">{{ $errors->first('password') }}</div>
            </p>
          </div>
          
          <!--<div class="two columns row alpha"><p>{{ Form::label('password_confirmation', 'Repita a senha*:') }}</p></div>
          <div class="two columns row omega"><p>{{ Form::password('password_confirmation') }}</p></div>
          -->
          <div class="four columns alpha omega">
          
            <p>Li e aceito os <a href="{{ URL::to('/termos') }}" target="_blank" style="text-decoration: underline;">termos de compromisso</a>: {{ Form::checkbox('terms', 'read') }}</p>
			<p><a href="http://creativecommons.org/licenses/?lang=pt" id="creative_commons" style="text-decoration:underline;">Creative Commons</a></p>
            <p>
              <div class="error">{{ $errors->first('terms') }}</div>
            </p>
          
            <br>
            <p>{{ Form::submit("CADASTRAR", array('class'=>'btn right')) }}</p>
          
          </div>
          
        {{ Form::close() }}
        
        <p>&nbsp;</p>
        
      </div>
      
    </div>
    
  </div>
    
@stop