{!!Form::open(array('url'=>'producto','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
<div class="row">
	<div class="col-lg-7">
		<div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control" name="searchText" placeholder="Ingrese código o nombre..." value="{{$searchText}}">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
				</span>
				
			</div>
		</div>
	</div>
</div>
{{Form::close()}}