

<?php if (count($model)==0){echo "<br>Sorry No Result Found<br>";}?>

@foreach ($model as $row)
<div class="form-group">

                                                    <input class="filgroup mod" type="checkbox" name="carmodel[]" value={{$row->model_id}}>
                                                    <label for="{{$row->model_id}}"><span>{{$row->name}}</span></label>

                                                   
                                                </div> <input class="offsetmodel" id="offsetmodel" type="hidden" value={{$offsetmodel}} />

@endforeach
