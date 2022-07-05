

<?php if (count($passengercapacity)==0){echo "<br>Sorry No Result Found<br>";}?>

@foreach ($passengercapacity as $row)
<div class="form-group">

                                                   <input class="filgroup pc" type="checkbox" id="{{$row->seats}}" name="carpassengercapacity[]" value="{{$row->seats}}">
                                                    <label for="{{$row->seats}}"><span>{{$row->seats}}</span></label>

                                                   
                                                </div> <input class="offsetpassengercapacity" id="offsetpassengercapacity" type="hidden" value={{$offsetpassengercapacity}} />

@endforeach
