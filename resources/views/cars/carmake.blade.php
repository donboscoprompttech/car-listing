

<?php if (count($make)==0){echo "<br>Sorry No Result Found<br>";}?>

@foreach ($make as $row)
<div class="form-group">

                                                    <input class="filgroup" type="checkbox" name="carmake[]" value={{$row->make_id}} >
                                                    <label for="{{$row->make_id}}"><span>{{$row->name}}</span></label>

                                                   
                                                </div> <input id="offsetmake" type="hidden" value={{$offset}} />

@endforeach
