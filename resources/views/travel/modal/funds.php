<div class="modal-content">
	<div class="modal-body">
		<h3>Funding</h3>
		<p>Choose funding for this travel</p><hr/><br/>
		<form name="funding-form" id="funding-form">
			<div class="row fund-section">
				<div class="col col-md-4">
					<select class="form-control" id="source_of_fund_field">
						<option value="opf">Select source of fund</option>
						<option value="opf">Operating Funds</option>
						<option value="otf" id="otf">Other Funds</option>
						<option value="op">Obligations Payable</option>
						<option value="sf">Special Funds</option>
						<option value="opfs">Operating Funds(Scholar)</option>
						<option value="otfs">Other Funds(Scholar)</option>
					</select>
				</div>

				<div class="col col-md-4">
					<input type="text" class="form-control" id="cost_center_field" placeholder="Cost Center/ Project ">
				</div>
				<div class="col col-md-4">
					<select class="form-control" id="line_item">
						
					</select>
				</div>
		  	</div>
		  </form>

	</div>

	<div class="modal-footer">
		<button class="btn btn-primary modal-submit-funding"  data-dismiss="modal" aria-label="Add">Add</button>
		<button class="btn btn-default" data-dismiss="modal" aria-label="Close">Cancel</button>
	</div>

</div>





