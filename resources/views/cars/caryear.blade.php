

<?php if (count($year)==0){echo "<br>Sorry No Result Found<br>";}?>

@foreach ($year as $row)
<div class="form-group">

                                                   <input  class="filgroup year" type="checkbox" id="{{$row->registration_year}}" name="year[]" value="{{$row->registration_year}}">
                                                    <label for="{{$row->registration_year}}"><span>{{$row->registration_year}}</span></label>

                                                   
                                                </div> 

@endforeach
<input id="offsetyear" class="offsetyear" type="hidden" value={{$offsetyear}} />