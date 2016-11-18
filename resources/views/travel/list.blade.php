<div class="col col-md-12"></div>
<div class="col col col-md-3 col-sm-3 hidden-xs">
	<p class="page-header"><span class="glyphicon glyphicon-th-large"></span> <b>Travel Request</b></p>
	<ul class="list-unstyled">
		<li><a href="#">Official</a></li>
		<li><a href="#">Personal</a></li>
		<li><a href="#">Campus</a></li>
	</ul>
	<p class="page-header"><b>Options</b></p>
	<div class="col col-md-12 row pull-left">
		<div class="col col-md-1"><span class="glyphicon glyphicon-search basket" search=""></span> </div> 
		<div class="col col-md-10">
			<input type="text" class="form-control" placeholder="search" id="searchInput" autofocus="">
		</div>
	</div>
	<div style="clear:both;"></div>
	<br/>
	<p><input type="radio" name="sort"><span id="sortBox"><a sort-list="false"> Sort up <span class="glyphicon glyphicon-chevron-up"></span></a></span></p>
	<p><input type="radio" name="sort"><span id="sortBox"><a sort-list="true"> Sort down <span class="glyphicon glyphicon-chevron-down"></span></a></span></p>
</div>


<div class="col col col-md-2 col-sm-9 hidden-sm hidden-xs">
	<dl class="row list-details">
		
		<dd>
			<h4 class="page-header"><b>5690</b></h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
		</dd>

		<dd>
			<h4 class="page-header"><b>5691</b></h4>
			<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
		</dd>


		<dd>
			<h4 class="page-header"><b>5692</b></h4>
			<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo</p>
		</dd>
	</dl>

	<p class="row">
			<b class="text-danger">Page /40</b>
			<input type="number" class="form-control" value="1" pagers="">
		</p>
</div>




<div class="col col-md-6 col-md-offset-1 col-sm-9 pull-right">
	@include('travel/tr-personal-preview')
</div>

