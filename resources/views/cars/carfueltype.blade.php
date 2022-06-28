

<?php if (count($fueltype)==0){echo "<br>Sorry No Result Found<br>";}?>

@foreach ($fueltype as $row)
<div class="form-group">

                                                   <input class="filgroup ft" type="checkbox" id="{{$row->fuel_type}}" name="carfueltype[]" value="{{$row->fuel_type}}">
                                                    <label for="{{$row->fuel_type}}"><span>{{$row->fuel_type}}</span></label>

                                                   
                                                </div> <input id="offsetfueltype" type="hidden" value={{$offsetfueltype}} />

@endforeach
