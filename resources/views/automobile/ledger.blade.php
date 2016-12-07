	<div>
		<h1 style="color:#ff9933"><span class="glyphicon glyphicon-menu-right"></span>Ledger</h1>
		<div class="col col-md-12 ">
			<h3 class="pull-right">
				<span class="text-muted">
					<span prev-year=""><span class="glyphicon glyphicon-menu-left"></span></span>
				</span> 
				<span class="text-muted ng-binding"  next-year=""><span class="glyphicon glyphicon-calendar"></span> 2016 </span>

				<span class="text-muted">
					<span next-year=""> <span class="glyphicon glyphicon-menu-right"></span></span>
				</span>
			</h3>
		</div>

		<section class="col col-md-11 ng-scope" ng-repeat="(key,value) in months" ledger="6" data-year="2016" style="display: block;">
			<h2 class="page-header ng-binding"  style="color:#ff9933">June</h2>
			<div class="ledgerContent ng-scope"><div class="table-fluid">
				<table class="ledgerContentTable table table-striped gasSpan ">
					<thead><tr><th>Date</th><th>Automobile</th> <th>PARTICULARS (work done)</th> <th>Details</th> <th>Amount</th><th>Repair Shop/Gasoline Station</th></tr></thead>
					<tbody>
						<!-- ngRepeat: item in ledger[6].items -->
						<tr ng-repeat="item in ledger[6].items" context="9" data-selection="repair" data-menu="listMenu" class="ng-scope"><td class="ng-binding">2016-06-08 15:17:34</td>
							<td><a href="#/sys/mobile/cust/1598fd/info" class="ng-binding">1598fd</a></td> 
							<td class="ng-binding">horn</td> 
							<td class="ng-binding">not working</td> 
							<td class="ng-binding">Php 5,000.00</td> 
							<td class="ng-binding"></td>
						</tr>
					</tbody>
				</table>
				<span class="pull-right"> &nbsp;&nbsp; <span class="btn btn-sm btn-default" print-ledger="6"><span class="glyphicon glyphicon-print"></span> print </span></span> <p class="pull-right ng-binding"> Total amount : Php 10,850.00 </p></div></div>
		</section>

	</div>
