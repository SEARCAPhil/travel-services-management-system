{{csrf_field()}}
<p><div class="vehicle" style="float: left;width:20px;height:20px;background: rgb(255,100,99);border-radius: 50%;color:rgb(255,255,255);text-align: center;cursor:pointer;">+</div> &nbsp;Vehicle<!--<a href="#"><div class="status-box status-box-sm gray">+</div>Vehicle</a>--></p>
<section class="automobile-list"></section>

<div class="backdrop">
		<div class="modalx">
			
		</div>
	</div>
<script type="text/javascript" src="js/common.js"></script>	
<script type="text/javascript" src="js/directory.js"></script>
<script type="text/javascript" src="js/automobile.js"></script>	
<script type="text/javascript">
$(document).ready(function(){
	showAutomobileList();

	if(localStorage.getItem('priv')==='admin'){
		bindAddAutomobile()
	}

})
</script>

