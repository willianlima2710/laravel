<form method="get" action="{{ $rota }}" autocomplete="off" role="search" > 
	<div class="col-xs-4">
		<div class="input-group">	
			<input type="text" class="form-control" name="searchText" placeholder="Buscar..." autocomplete="off" value="{{$searchText}}">
			<span class="input-group-addon">
				<button type="submit" class="fa fa-search" style="background:transparent;border:none"></button>
			</span>
		</div>
	</div>			
</form>