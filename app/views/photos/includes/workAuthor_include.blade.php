<div class="{{$first_column}} columns alpha">
  <p>{{ Form::label('photo_workAuthor', 'Autor da obra:') }}</p>
</div>
<div class="{{ $type_field }} columns">
     <p>
           {{ Form::text('photo_workAuthor', '',array('id' => 'photo_workAuthor', 'placeholder' => 'SOBRENOME, nome','style'=>'height:15px; width:280px; font-size:12px; border:solid 1px #ccc')) }}
             <button class="btn" id="add_work_authors" style="font-size: 11px;">ADICIONAR</button>
             <br>
             <div class="error">{{ $errors->first('work_authors') }}</div>
     </p>
</div>
<div class="{{$text_area_field}} columns alpha">
     <textarea name="work_authors" id="work_authors" cols="60" rows="1" class="{{$size_area_author}}" style="display: none;"></textarea>
</div>
            </br>
            </br>