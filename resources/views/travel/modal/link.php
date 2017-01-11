<div class="modal-content">
	<div class="modal-body">
		<h3>Travel Directory</h3>
		<p>Please review details of the travel before doing any further actions.</p>
		<p><hr/></p>
		<article class="link-list-section">
			Loading . . .
		</article>
	</div>
	<div class="modal-footer">
		<button class="btn btn-danger modal-submit">Proceed</button>
		<button class="btn btn-default" data-dismiss="modal" aria-label="Close">Cancel</button>
	</div>

</div>

<script type="text/javascript">
	$('.link-list').on('click',function(){
		$('.link-list').removeClass('active');
		$(this).addClass('active')

		var id=$(this).attr('id');
	})
</script>