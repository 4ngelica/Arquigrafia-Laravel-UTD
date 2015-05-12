@extends('layouts.default')

@section('head')

{{ HTML::style('/css/style.css'); }}

<title>Arquigrafia - {{ $photos->name }}</title>

<link rel="stylesheet" type="text/css" media="screen" href="{{ URL::to("/") }}/css/checkbox.css" />

<link rel="stylesheet" type="text/css" media="screen" href="{{ URL::to("/") }}/css/jquery.fancybox.css" />

<script type="text/javascript" src="{{ URL::to("/") }}/js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="{{ URL::to("/") }}/js/photo.js"></script>


@stop

	@section('content')

    @if (Session::get('message'))
      <div class="container">
        <div class="twelve columns">
          <div class="message">{{ Session::get('message') }}</div>
        </div>
      </div>
    @endif

		<!--   MEIO DO SITE - ÁREA DE NAVEGAÇ?Ã?O   -->
		<div id="content" class="container">
			<!--   COLUNA ESQUERDA   -->
			<div class="eight columns">
				<!--   PAINEL DE VISUALIZACAO - SINGLE   -->
				<div id="single_view_block">
					<!--   NOME / STATUS DA FOTO   -->
					<div>
						<div class="four columns alpha">
            	<h1>{{ $photos->name }}</h1> 

            </div>


			<div class="four columns omega">              
              <span class="right"><i id="comments"></i> <small>{{$commentsCount}}</small>
              </span>            
             
            </div>
					</div>
					<!--   FIM - NOME / STATUS DA FOTO   -->
					
          <!--   FOTO   -->
					<a class="fancybox" href="{{ URL::to("/arquigrafia-images")."/".$photos->id."_view.jpg" }}" title="{{ $photos->name }}" ><img class="single_view_image" style="" src="{{ URL::to("/arquigrafia-images")."/".$photos->id."_view.jpg" }}" /></a>
 

				</div>				
				
				<!--   BOX DE BOTOES DA IMAGEM   -->
				<div id="single_view_buttons_box">
					
					<?php if (Auth::check()) { ?>
						
	            <ul id="single_view_image_buttons">						             
							
							<li><a href="{{ URL::to('/albums/get/list/' . $photos->id) }}" title="Adicione aos seus álbuns" id="plus"></a></li>
            
							<li><a href="{{ asset('photos/download/'.$photos->id) }}" title="Faça o download" id="download" target="_blank"></a></li>
           	
						</ul>
            
             <?php } else { ?>
              <div class="six columns alpha">Faça o login para fazer o download e comentar as imagens.</div>
            <?php } ?>
            
						<ul id="single_view_social_network_buttons">
						<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4fdf62121c50304d"></script>	
							<li><a href="#" class="google addthis_button_google_plusone_share"><span class="google"></span></a></li>
							<li><a href="#" class="facebook addthis_button_facebook"><span class="facebook"></span></a></li>
							<li><a href="#" class="twitter addthis_button_twitter"><span class="twitter"></span></a></li>
						</ul>
					
				</div>
				<!--   FIM - BOX DE BOTOES DA IMAGEM   -->
        
        <div class="tags">
        	<h3>Tags:</h3>

					<p>        

          <p>
          @if (isset($tags))
            @foreach($tags as $tag)
              @if ($tag->id == $tags->last()->id)              
                {{ $tag->name }}             
              @else              
                {{ $tag->name }},          
              @endif          
            @endforeach
          @endif   
          
          </p>
          </div>


@if (!empty($average))  
  <div id="evaluation_average">
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
      $(function () {     
        var l1 = [
            @foreach($binomials as $binomial)
              '{{ $binomial->firstOption}}',     
            @endforeach
        ];      
        var l2 = [
            @foreach($binomials as $binomial)
              '{{ $binomial->secondOption }}',       
            @endforeach
        ];    
        $('#evaluation_average').highcharts({
            credits: {
                enabled: false,
            },
            chart: {
                marginRight: 80,          
            },
            title: {
                text: '<b> Média de Avaliações d{{$architectureName}} </b>'
            },
            tooltip: {
              formatter: function() {
              return ''+ l1[this.y] + '-' + l2[this.y] + ': <br>' + this.series.name + '= ' + this.x;
              },
              crosshairs: [true,true]
            },
            xAxis: {
                lineColor: '#000',
                min: 0,
                max: 100,
            },
            yAxis: [{
                lineColor: '#000',
                lineWidth: 1,            
                tickAmount: {{$binomials->count()}},              
                tickPositions: [
                  <?php $count = 0?>
                  @foreach($binomials as $binomial)
                    {{ $count }},
                    <?php $count++; ?>
                  @endforeach
                ],
                title: {
                    text: ''
                },
                labels: {
                  formatter: function() {
                    return l1[this.value];
                  }
                }
            }, {                
                lineWidth: 1,
                tickAmount: {{$binomials->count()}},  
                tickPositions: [
                  <?php $count = 0?>
                  @foreach($binomials as $binomial)
                    {{ $count }},
                    <?php $count++; ?>
                  @endforeach
                ],
                opposite: true,
                title: {
                    text: ''
                },
                labels: {
                  formatter: function() {
                    return l2[this.value];
                  }
                },
            }],

            series: [{            
                <?php $count = 0; ?>
                data: [ 
                  @foreach($average as $avg)
                    [{{ $avg->avgPosition }}, {{ $count }}],                      
                    <?php $count++ ?>
                  @endforeach
                ],
                yAxis: 1,
                name: 'Média',            
                marker: {
                  symbol: 'circle',
                  enabled: true
                },
                color: '#999999',
            }, {            
                <?php $count = 0; ?> 
                data: [
                  @if(isset($userEvaluations) && !$userEvaluations->isEmpty())
                    @foreach($userEvaluations as $userEvaluation)
                      [{{ $userEvaluation->evaluationPosition }}, {{ $count }}], 
                      <?php $count++ ?>
                    @endforeach              
                  @endif
                ],
                yAxis: 0,
                name: 'Sua avaliação',
                marker: {
                  symbol: 'circle',
                  enabled: true
                },
                color: '#000000',
            }]
        });
      });
    </script>
  </div>
@endif      
				
        
        
        
        
			</div>
			<!--   FIM - COLUNA ESQUERDA   -->
			<!--   SIDEBAR   -->
			<div id="sidebar" class="four columns">
				<!--   USUARIO   -->
				
        <div id="single_user" class="clearfix row">
				  
          
          <a href="{{ URL::to("/users/".$owner->id) }}" id="user_name">
            <?php if ($owner->photo != "") { ?>
              <img id="single_view_user_thumbnail" src="<?php echo asset($owner->photo); ?>" class="user_photo_thumbnail"/>
            <?php } else { ?>
              <img id="single_view_user_thumbnail" src="{{ URL::to("/") }}/img/avatar-48.png" width="48" height="48" class="user_photo_thumbnail"/>
            <?php } ?>
          </a>  
          
          
          
					<h1 id="single_view_owner_name"><a href="{{ URL::to("/users/".$owner->id) }}" id="name">{{ $owner->name }}</a></h1>
    		@if (Auth::check() && $owner->id != Auth::user()->id)
    			@if (!empty($follow) && $follow == true)
	    			<a href="{{ URL::to("/friends/follow/" . $owner->id) }}" id="single_view_contact_add">Seguir</a><br />
 				  @else
            <div>Seguindo</div>
 				  @endif
			  @endif	
				</div>
				<!--   FIM - USUARIO   -->				
        
        <!-- AVALIAÇÃO -->
               
        <h3>Avaliação d{{$architectureName}}</h3> 
        
			 
        <p>Avalie a arquitetura apresentada nesta imagem de acordo com seus aspectos, compare também sua avaliação com as dos outros usuários.</p>
               
        <!-- FORMULÁRIO DE AVALIAÇÃO -->
        <div id="evaluation_box">         
        
          <?php if (Auth::check()) { ?>
              
            {{ Form::open(array('url' => "photos/{$photos->id}/saveEvaluation")) }}

            <script>
              function outputUpdate(binomio, val) {                        
                document.querySelector('#leftBinomialValue'+binomio).value = 100 - val;
                document.querySelector('#rightBinomialValue'+binomio).value = val;                                         
              }
            </script> 
            
              <?php 
                $count = $binomials->count() - 1;
                // fazer um loop para cada e salvar como uma avaliação
                foreach ($binomials->reverse() as $binomial) { ?>

                  
                  
                  <p>
                    <table border = 0 width= 230>
                      <tr>
                        <td width=110>{{ Form::label('value-'.$binomial->id, $binomial->firstOption) }} 
                    @if (isset($userEvaluations) && !$userEvaluations->isEmpty())
                            <?php $userEvaluation = $userEvaluations->get($count) ?>
                            (<output for=fader{{$binomial->id}} id=leftBinomialValue{{$binomial->id}}>{{100 - $userEvaluation->evaluationPosition}}</output>%)</td>
                            <td align="right"> {{ Form::label('value-'.$binomial->id, $binomial->secondOption) }} 
                            (<output for=fader{{$binomial->id}} id=rightBinomialValue{{$binomial->id}}>{{$userEvaluation->evaluationPosition}}</output>%)</td>
                      </tr>
                    </table> 
                            {{ Form::input('range', 'value-'.$binomial->id, $userEvaluation->evaluationPosition, ['min'=>'0','max'=>'100', 
                      'oninput'=>'outputUpdate(' . $binomial->id . ', value)']) }} 

                    @else
                            (<output for=fader{{$binomial->id}} id=leftBinomialValue{{$binomial->id}}>{{100 - $binomial->defaultValue}}</output>%)</td>
                            <td align="right"> {{ Form::label('value-'.$binomial->id, $binomial->secondOption) }} 
                            (<output for=fader{{$binomial->id}} id=rightBinomialValue{{$binomial->id}}>{{$binomial->defaultValue}}</output>%)</td>
                            </tr>
                    </table> 
                             {{ Form::input('range', 'value-'.$binomial->id, $binomial->defaultValue, ['min'=>'0','max'=>'100',
                      'oninput'=>'outputUpdate(' . $binomial->id . ', value)']) }} 

                    @endif 

                    <?php $count-- ?>  
                  </p>
                  
              <?php } ?>
              
               <a href="{{ URL::to('/photos/' . $photos->id) }}" class='btn right'>VOLTAR</a>
              {{ Form::submit('AVALIAR', ['id'=>'evaluation_button','class'=>'btn right']) }} 
                
            {{ Form::close() }}
            
            
          <?php } else { ?>
            @if (empty($average)) 
              <p>Faça o <a href="{{ URL::to('/users/login') }}">Login</a> e seja o primeiro a avaliar {{$architectureName}}</p>
            @else
              <p>Faça o <a href="{{ URL::to('/users/login') }}">Login</a> e avalie você também {{$architectureName}}</p>
            @endif            
          <?php } ?>
        
        </div>

      </br>
    </br>

      <!--   BOX DE COMENTARIOS   -->
        <div id="comments_block" class="eight columns row alpha omega">
          <h3>Comentários</h3>
          
          <?php $comments = $photos->comments; ?>
          
          @if (!isset($comments))          
         
          <p>Ninguém comentou sobre {{$architectureName}}. Seja o primeiro!</p>
          
          @endif
          
          <?php if (Auth::check()) { ?>
            
            {{ Form::open(array('url' => "photos/{$photos->id}/comment")) }}
              <div class="column alpha omega row">
              <?php if (Auth::user()->photo != "") { ?>
                <img class="user_thumbnail" src="{{ asset(Auth::user()->photo); }}" />
              <?php } else { ?>
                <img class="user_thumbnail" src="{{ URL::to("/") }}/img/avatar-48.png" width="48" height="48" />
              <?php } ?>
              </div>
              
              <div class="three columns row">
                <strong><a href="#" id="name">{{ Auth::user()->name }}</a></strong><br>
                Deixe seu comentário <br>
                {{ $errors->first('text') }}
                {{ Form::textarea('text', '', ['id'=>'comment_field']) }}
                {{ Form::hidden('user', $photos->id ) }}
                {{ Form::submit('COMENTAR', ['id'=>'comment_button','class'=>'cursor btn']) }}
              </div>
            {{ Form::close() }}
            
            <br class="clear">
            
          <?php } else { ?>            
            <p>Faça o <a href="{{ URL::to('/users/login') }}">Login</a> e comente sobre {{$architectureName}}</p>
          <?php } ?>
          
          @if (isset($comments))
          
            @foreach($comments as $comment)
            <div class="clearfix">
              <div class="column alpha omega row">                
                <!--<img class="user_thumbnail" src="{{ URL::to("/") }}/img/avatar-48.png" width="48" height="48" />-->
                <?php if ($comment->user->photo != "") { ?>
                  <img class="user_thumbnail" src="{{ asset($comment->user->photo); }}" />
                <?php } else { ?>
                  <img class="user_thumbnail" src="{{ URL::to("/") }}/img/avatar-48.png" width="48" height="48" />
                <?php } ?>


              </div>
              <div class="four columns omega row">
                <small>{{$comment->user->name}} - {{$comment->created_at->format('d/m/Y h:m') }}</small>
                <p>{{ $comment->text }}</p>
              </div>        
            </div>       
            @endforeach
          
          @endif    
          
          
          
          
        </div>
        <!-- FIM DO BOX DE COMENTARIOS -->
        
              
			<!--   FIM - SIDEBAR   -->
		</div>
    
		<!--   MODAL   -->
		<div id="mask"></div>
		<div id="form_window" class="form window">
			<!-- ÁREA DE LOGIN - JANELA MODAL -->
			<a class="close" href="#" title="FECHAR">Fechar</a>
			<div id="registration"></div>
		</div>
		<div id="confirmation_window" class="window">
			<div id="registration_delete">
				<p></p>
				{{ Form::open(array('url' => '', 'method' => 'delete')) }}
					<div id="registration_buttons">
						<input type="submit" class="btn" value="Confirmar" />
						<a class="btn close" href="#">Cancelar</a>
					</div>
				{{ Form::close() }}
			</div>
		</div>

@stop