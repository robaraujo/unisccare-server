<!-- Staff Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('title', 'Título:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required'=> true]) !!}
</div>

<!-- Food Ids Field -->
<div class="foods-wrapper container">
    @foreach ($selected_foods as $food)
        <div class="food-item row">
            <div class="col-md-9 col-xs-6">
                {!! Form::label('food_id', 'Alimento:') !!}
                {!! Form::select('food_id[]', $foods, $food['food_id'],
                    ['class' => 'form-control', 'required'=> true])
                    !!}
            </div>
            <div class="col-md-1 col-xs-3">
                {!! Form::label('food_qtt', 'Quantidade:') !!}
                {!! Form::number('food_qtt[]', $food['qtt'], ['class' => 'form-control', 'required'=> true]) !!}
            </div>
            <div class="col-md-2 col-xs-3">
                <label class="form-label">&nbsp;</label>
                <div>
                    <button type="button" onclick="addFood()" class="btn-add btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i>    
                    </button>
                    <button type="button" class="btn-rm btn btn-danger btn-sm">
                        <i class="fa fa-minus"></i>    
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="clearfix"></div>
<br>

<!-- User Ids Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('user_id', 'Usuários:') !!}
    {!! Form::select('user_id[]', $users, $selected_users, ['multiple'=>'multiple', 'class' => 'form-control', "id"=>"users-list"]) !!}
        <small>Deixe em branco para disponibilizar para todos
            <button type="button" class="btn btn-link inline" onclick="jQuery('#users-list').val('');">todos</button>
        </small>
</div>

<!-- Active Field -->
<div class="form-group col-sm-6">
    {!! Form::label('active', 'Active:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('active', false) !!}
        {!! Form::checkbox('active', '1', true) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('staff.diets.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
<script type="text/javascript">
    function addFood() {
        var $elem = $('.food-item').first().clone();
        $elem.find('select').val(null);
        $elem.find('input').val(1);
        $elem.appendTo( $('.foods-wrapper') );

        bindBtnRemove();        
    }

    function bindBtnRemove() {
        $('.foods-wrapper').find('.btn-rm').unbind('click').click(function() {
            $(this).closest('.food-item').remove();
        });
    }

    function removeFood(e) {
        console.log(e)
    }

    $(function() {
        bindBtnRemove();
    });
</script>
@endsection