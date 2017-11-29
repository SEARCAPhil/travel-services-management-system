<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Official;
use App\Http\Controllers\Official_itenerary;
use App\Http\Controllers\Official_staff;
use App\Http\Controllers\Official_scholars;
use App\Http\Controllers\Official_custom;
use App\Http\Controllers\Directory;
use App\Http\Controllers\Charge;

use PDF;

session_start();

error_reporting(0);
class Official_printables extends Controller
{


	function is_exist($array,$value){
		$is_exist=0;
		for($x=0;$x<count($array);$x++){
			if($array[$x]->uid==$value->uid){
				$is_exist=1;
			}
		}

		return $is_exist;
	}

	function is_exist_custom($array,$value){
		$is_exist=0;
		for($x=0;$x<count($array);$x++){
			if($array[$x]->full_name==$value->full_name){
				$is_exist=1;
			}
		}

		return $is_exist;
	}

	function is_creator($id){
		if($_SESSION['priv']!='admin'){
			if($id!=@$_SESSION['id']){

				echo '<br/><br/><center><h3>Sorry! File not found.</h3></center>';
				exit;
			}
		}
	}

    function print_trip_ticket($id){
    	
		

    	$itenerary=Array();
    	$charges=Array();
    	$staff=Array();
    	$scholars=Array();
    	$custom=Array();


   	

    	#get data
    	$official_itenerary=new Official_itenerary();
    	$official_travel=new Official();
    	$charge_travel=new Charge();

    	$official_staff=new Official_staff();
    	$official_scholars=new Official_scholars();
    	$official_custom=new Official_custom();



    	$itenerary=@json_decode($official_itenerary->show($id))[0];
    	$charges=@json_decode($official_itenerary->show_charges($id))[0];
    	$travel_request=@json_decode($official_travel->show($itenerary->tr_id))[0];



    	$staff=json_decode($official_staff->index($itenerary->tr_id));
    	$scholars=json_decode($official_scholars->index($itenerary->tr_id));
    	$custom=json_decode($official_custom->index($itenerary->tr_id));


    	#charges comutation
    	/*var_dump($charges);
    	
    	$gasoline_charge=$charge_travel->calculate_gasoline_charge($charges->base,$charges->end-$charges->start,$charges->gasoline_charge,$default_rate='25');
    	

    	if($charges->appointment=='emergency'){
    		$drivers_charge=($charge_travel->calculate_emergency_drivers_charge($itenerary->departure_date,$itenerary->departure_time,$itenerary->returned_date,$itenerary->returned_time,$charges->drivers_charge));
    	}else{
			$drivers_charge=($charge_travel->calculate_contracted_drivers_charge($itenerary->departure_date,$itenerary->departure_time,$itenerary->returned_date,$itenerary->returned_time,$charges->drivers_charge,$charges->days));
    	}

    	$overall_gasoline_charge=@array_sum($gasoline_charge);
    	$overall_charge=$overall_gasoline_charge+$drivers_charge;*/
    	


    	
    	

    	$linked_travel=json_decode($official_itenerary->show_linked_travel($id));

    	#all staff array
    	$staff_array=Array();
    	$scholars_array=Array();
    	$custom_array=Array();
    	
    	#linked travel
    	for($x=0; $x<count(@$linked_travel->data); $x++){
    	
    			$pass=json_decode($official_staff->index($linked_travel->data[$x]->tr_id));
    			for ($i=0; $i<count($pass); $i++) {

    				if(!self::is_exist($staff,$pass[$i])){
    					array_push($staff, $pass[$i]);
    				} 
    				
    			}

    			$pass=json_decode($official_scholars->index($linked_travel->data[$x]->tr_id));
    			for ($i=0; $i <count($pass); $i++) { 

    				if(!self::is_exist($scholars,$pass[$i])){
    					array_push($scholars, $pass[$i]);
    				}
    				
    			}

    			$pass=json_decode($official_custom->index($linked_travel->data[$x]->tr_id));
    			for ($i=0; $i <count($pass); $i++) { 

    				if(!self::is_exist_custom($custom,$pass[$i])){
    					array_push($custom, $pass[$i]);
    				}
    				
    			}	


    	}

    
    	
    	array_push($staff_array, $staff);

    	$merged_staff=$staff_array;


    	


    	//get default settings from config/laravel-tcpdf.php
   		$pdf_settings = \Config::get('laravel-tcpdf');

   		$pdf = new \Elibyy\TCPDF\TCPDF($pdf_settings['page_orientation'], $pdf_settings['page_units'], array(210,297), true, 'UTF-8', false);
   		


   		// Custom Header
		$pdf->setHeaderCallback(function($pdf) {

			// Title
			// set cell margins

			$pdf->Ln(10);
		
			$pdf->setFontSize(9);
			//$this->image("../model/img/Logo Searca.png",20,'',15);
			//$this->Cell(0, 0, '<img src="../model/img/Logo Searca.png"/>', 0, 2, 'L', 0, '', 0, false, 'T', 'B');
			//$this->Cell(0, 0, 'Southeast Asian Ministers of Education Organization', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->Cell(0, 0, 'SOUTHEAST ASIAN REGIONAL CENTER FOR GRADUATE STUDY', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->Cell(0, 0, ' AND RESEARCH IN AGRICULTURE', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->Cell(0, 0, 'College, Laguna, 4031, Philippines', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->setFontSize(15);
			$pdf->Cell(0, 10, 'TRIP TICKET', 0, 2, 'C', 0, '', 0, false, 'T', 'B');


			$foot='	<article class="col col-md-12" style="font-size:7px;">

					
					<table style="font-size:10px;">
						<tr>
							<td colspan="3"><hr/></td>
						</tr>
						<tr>
							<td colspan="3">To be prepared in quadruplicate.</td>
						</tr>
						<tr>
							<td>White-Customer </td> <td>Pink - Office/unit</td> <td>Yellow - Accounting</td> <td>Green - Cashier</td>
						</tr>
					</table>
					
				</article>';



		if ($pdf->getPage() <= $pdf->getAliasNumPage()) {
			$pdf->SetY(-30);
			$pdf->Writehtml($foot);
		}



		});

		// Custom Footer
		$pdf->setFooterCallback(function($pdf) {

			$pdf->SetY(-50);
			// Set font
	        $pdf->SetFont('helvetica', 'N', 9);

	        // Position at 15 mm from bottom
	        $pdf->SetY(-15);
	       	$pdf->SetFont('helvetica', 'I', 8);
	        // Page number
	        $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');


	       


  	  	});



		//settings
		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, 35, PDF_MARGIN_RIGHT);

		self::is_creator($travel_request->uid);





    	// create some HTML content
$html ='<style>

			.sa-table{margin-bottom:20px; border:1px solid rgb(80,80,80);}
			.sa-table td{margin-bottom:20px; border:1px solid rgb(80,80,80);}
			.withLine{border-bottom:1px solid rgb(20,20,20);overflow:hidden;text-align:left;padding-bottom:10px;margin-right:50px;}
		</style>


	<article>

		<table>
			<tr>
				<td width="220"></td><td></td><td width="100"><b>NO. '.$id.'</b></td>
			</tr>

			
		</table>
		<br/>

		<table>
			<tr>
				<td width="220"></td><td></td><td class="withLine" style="text-align:center;"  width="100"><b>'.date_format(date_create($travel_request->date_created),'m/d/Y') .'</b></td>
			</tr>
			<tr>
				<td></td><td></td><td style="text-align:center;"><b>Date</b></td>
			</tr>

			
		</table>

	</article>';
	
$html.='	<article class="col col-md-12">
		<table class="table table-bordered sa-table "  style="font-size:0.8em;" cellspacing="0">
			<tr class="mini-tr">
				<td>
					<p> <input type="checkbox" checked="checked"/>UPLB and Vicinity</p>
					<p> <input type="radio">Out-of-town</p> 

				</td>
				<td>
					<p><label> <b>Date:</b></label> <span> </span></p>
					
				</td>				
			</tr>


			<!--requesting party-->
			<tr>
				<td> Requesting Party</td>
				<td> Source of fund:  <b> '.$travel_request->source_of_fund_value.'</b>'; 

			if($travel_request->source_of_fund=='otf'){
				$html.='<br/><br/><b>'.@$travel_request->projects[0]->project.'</b><br/>';
			}
					

	$html.='			</td>

			</tr>

			<!--passengers-->
			<tr>
				<td> <b>Passenger</b><br/>

						<table class="table passenger-table" id="table-passenger" cellspacing="3">
					
							<tr>
								<th><b>Name</b></th>
								<th>&nbsp;&nbsp;&nbsp;&nbsp;<b>Designation</b></th>
								<th>&nbsp;&nbsp;&nbsp;&nbsp;<b>Office/Unit</b></th>
							</tr>
					';

	#fetch intenerary result
	$staff_total_count=count($staff);
	$scholars_total_count=count($scholars);
	$custom_total_count=count($custom);

	$passenger_count=0;


	for($a=0;$a<$staff_total_count;$a++){
		$passenger_count++;
		$html.='<tr class="tr-passenger">
				<td class="withLine">'.$staff[$a]->name.'</td>
				<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;'.$staff[$a]->designation.'</td>
				<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;'.$staff[$a]->alias.'</td>
			</tr>';	
	}




	for($a=0;$a<$scholars_total_count;$a++){
		$passenger_count++;
		$html.='<tr class="tr-passenger">
				<td class="withLine">'.$scholars[$a]->full_name.'</td>
				<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;'.$scholars[$a]->nationality.'</td>
				<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;<i>Scholar</i></td>
			</tr>';	
	}

	for($a=0;$a<$custom_total_count;$a++){
		$passenger_count++;
		$html.='<tr class="tr-passenger">
				<td class="withLine">'.$custom[$a]->full_name.'</td>
				<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;'.$custom[$a]->designation.'</td>
				<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;<i>N/A</i></td>
			</tr>';	
	}


	if($passenger_count<4){
		$remaining=5-$passenger_count;

		for($a=0;$a<$remaining;$a++){
			$html.='<tr class="tr-passenger">
					<td class="withLine"></td>
					<td class="withLine"></td>
					<td class="withLine"></td>
				</tr>';	
		}
	}






								
					
				
		$html .= '</table><br/><br/>';

			$html .= '	</td>
				<td> Purposes/Places to be visited: <b>'.htmlspecialchars($travel_request->purpose).'</b>
				</td>

			</tr>


			<!--destination-->
			<tr>
				<td> Report to: <b>'.$itenerary->location.'</b><br/>
				&nbsp;Destination: <b>'.$itenerary->destination.'</b><br/>
				</td>


				<td style="margin:0;padding:0;cellspacing:0;"> 

					<table>
						<tr style="border:none;">
							<td style="border-right:1px solid rgb(80,80,80);border-bottom:1px solid rgb(80,80,80);" width="80"></td>
							<td style="border-right:1px solid rgb(80,80,80);border-bottom:1px solid rgb(80,80,80);" width="100"> Date</td>
							<td style="border-bottom:1px solid rgb(80,80,80);" width="67"> Time</td>
						</tr>
						<tr style="border:none;">
							<td style="border-right:1px solid rgb(80,80,80);border-bottom:1px solid rgb(80,80,80);" width="80">Departure</td>
							<td style="border-right:1px solid rgb(80,80,80);border-bottom:1px solid rgb(80,80,80);" width="100"> <b>'.$itenerary->departure_date.'</b></td>
							<td style="border-bottom:1px solid rgb(80,80,80);" width="67"> <b>'.$itenerary->departure_time.'</b> </td>
						</tr>
						<tr style="border:none;">
							<td style="border-right:1px solid rgb(80,80,80);border-bottom:1px solid rgb(80,80,80);" width="80">Arrival</td>
							<td style="border-right:1px solid rgb(80,80,80);border-bottom:1px solid rgb(80,80,80);" width="100"> <b>'.$itenerary->returned_date.'</b></td>
							<td style="border-bottom:1px solid rgb(80,80,80);" width="67"> <b>'.$itenerary->returned_time.'</b></td>
						</tr>
					</table>

				</td>

			</tr>


			<!--Vehicle Plate-->
			<tr>
				<td> Vehicle/Plate no.:  <b>'.@$itenerary->manufacturer.'</b> <b>'.@$itenerary->plate_no.'</b>
			
				</td>
				<td> Assigned Driver: <b>'.@$itenerary->profile_name.'</b> </td>

			</tr>


			<!--station-->
			<tr>
				<td> Service Station.:
			
				</td>
				<td> 
					<table>
						<tr style="border:none;">
							<td style="border-right:1px solid rgb(80,80,80);" width="80"></td>
							<td style="border-right:1px solid rgb(80,80,80);" width="100"> OUT</td>
							<td> IN</td>
						</tr>
					</table>
				</td>

			</tr>


			<!--supplies-->
			<tr>

				<!--authorized-->

				<td> 

				<br/><br/>Authorized supplies/service:<br/><br/>

				<table cellspacing="2">
					 <tr>
					 	<td width="100"><b>QTY</b></td>
					 	<td><b>SUPPLIES/SERVICE</b></td>
					 </tr>
					 <tr>
					 	<td width="100" class="withLine"></td>
					 	<td>Gasoline</td>
					 </tr>
					 <tr>
					 	<td width="100" class="withLine"></td>
					 	<td>Diesel</td>
					 </tr>
					 <tr>
					 	<td width="100" class="withLine"></td>
					 	<td>Gear Oil</td>
					 </tr>
					 <tr>
					 	<td width="100" class="withLine"></td>
					 	<td>Engine Oil</td>
					 </tr>
					 <tr>
					 	<td width="100" class="withLine"></td>
					 	<td>Break Fluid</td>
					 </tr>
					 <tr>
					 	<td width="100" class="withLine"></td>
					 	<td>Transmission Fluid</td>
					 </tr>
					 <tr>
					 	<td width="100" class="withLine"></td>
					 	<td>Monthly Service</td>
					 </tr>
					 <tr>
					 	<td width="100" class="withLine"></td>
					 	<td>Others</td>
					 </tr>
				 </table>

				 <br/><br/><br/>

					 Approved By:<br/>

					 <table style="text-align:center;">
						 <tr>
						 	<td><b>RICARDO A. MENORCA</b></td>
						 </tr>
						 <tr>
						 	<td><p>Unit head,General Services</p></td>
						 </tr>
					 </table>
					
					

					<br/>
					<br/>
					<br/>
					 Delivered/ Serviced by:<br/><br/>
					 Date:<br/><br/>
					 Received by:<br/><br/>
					 Date:<br/><br/>

			
				</td>

				<!-- -->

				<td> 
					<br/><br/>
				<table>
					<tr>
						<td width="80">Date</td>
						<td width="100"><b>'.$itenerary->departure_date.'</b></td>
						<td><b>'.$itenerary->returned_date.'</b></td>
					</tr>
					<tr>
						<td width="80">Time</td>
						<td width="100"><b>'.$itenerary->departure_time.'</b></td>
						<td><b>'.$itenerary->returned_time.'</b></td>
					</tr>
					<tr>
						<td width="80">Mileage Reading</td>
						<td width="100">'.@$charges->start.'</td>
						<td>'.@$charges->end.'</td>
					</tr>
					<tr>
						<td width="80">Signature of driver</td>
						<td width="100"></td>
						<td></td>
					</tr>
					<tr>
						<td width="80">Attested by;</td>
						<td width="100"></td>
						<td></td>
					</tr>
					<tr>
						<td width="80">Guard-on-duty</td>
						<td width="100"></td>
						<td></td>
					</tr>
				</table>
				<br/><br/>
				<br/><br/>
				<br/><br/>
					<p>I hereby certify that the vehicle was used solely for the official purpose/s stated above.</p>
					<br/><br/><br/><br/><br/>
					<table style="text-align:center;">
						 <tr>
						 	<td width="20%"></td>
						 	<td class="withLine" width="60%"><b style="text-transform:uppercase;"></b></td>
						 	<td width="20%"></td>
						 </tr>
					 </table>
					 <table style="text-align:center;">
						 <tr>
						 	<td><p>Passenger\'s Signature</p></td>
						 </tr>
					 </table>
				</td>

			</tr>


			<!--accounting use-->
			<tr>
				<td> <b>For Accounting Unit\'s Use:</b> <br/><br/>
				 &nbsp;Gasoline/Diesoline <br/>
				 &nbsp;Toll Fees<br/>
				 &nbsp;Parking Fees<br/>
				 &nbsp;Per Diem<br/>
				 &nbsp;Depreciation<br/><br/>
				 <b>Total :</b>

			
				</td>
				<td> <b>For Motorpool Unit\'s Use:</b><br/><br/>
				 &nbsp; No. of kms. : <b>'.@($charges->end-$charges->start).' km/s </b><br/>
				 &nbsp; Rate/km : <b>'.@($charges->gasoline_charge).'</b><br/>
				 &nbsp;Amount : <b>'.@$charges->total.'</b><br/>  
				 ';

				 if(strlen(@$charges->notes)>1){
				 	$html.='<br/><b style="font-size:6px;">NOTE : '.@ucfirst($charges->notes).'</b>';
				 }

				 $html.='
				</td>

			</tr>
			
			
			

		</table>
	</article>
';





		
		$pdf->setFontSize(10);	

		//output
        $pdf->AddPage();
        $pdf->Writehtml($html);
        $pdf->output('Travel Request', 'I');


    
    }



    function print_travel_request($id){

    	
    	#variables
    	global $details;

    	$itenerary=Array();
    	$staff=Array();
    	$scholars=Array();
    	$custom=Array();
    	

    	#get data
    	$official=new Official();
    	$official_itenerary=new Official_itenerary();
    	$official_staff=new Official_staff();
    	$official_scholars=new Official_scholars();
    	$official_custom=new Official_custom();
    


    	$data=json_decode($official->show($id));
    	$details=$data[0];


    	//var_dump($details);
    	#get itenerary
    	if(isset($details->tr)){
    		$itenerary=json_decode($official_itenerary->index($details->tr));
    		$staff=json_decode($official_staff->index($details->tr));
    		$scholars=json_decode($official_scholars->index($details->tr));
    		$custom=json_decode($official_custom->index($details->tr));
    		

    	}
    	

    	



    	
    	//var_dump($details);
    	//get default settings from config/laravel-tcpdf.php
   		$pdf_settings = \Config::get('laravel-tcpdf');

   		$pdf = new \Elibyy\TCPDF\TCPDF($pdf_settings['page_orientation'], $pdf_settings['page_units'], array(210,297), true, 'UTF-8', false);
   		


   		// Custom Header
		$pdf->setHeaderCallback(function($pdf) {

			// Title
			// set cell margins
			$pdf->setFontSize(8);
			$pdf->Ln(8);
			$pdf->Cell(0, 5, 'SEARCA 91-004-1', 0, 2, 'L', 0, '', 0, false, 'T', 'T');
			$pdf->Ln(2);
			$pdf->setFontSize(9);
			//$this->image("../model/img/Logo Searca.png",20,'',15);
			//$this->Cell(0, 0, '<img src="../model/img/Logo Searca.png"/>', 0, 2, 'L', 0, '', 0, false, 'T', 'B');
			//$this->Cell(0, 0, 'Southeast Asian Ministers of Education Organization', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->Cell(0, 0, 'SOUTHEAST ASIAN REGIONAL CENTER FOR GRADUATE STUDY', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->Cell(0, 0, ' AND RESEARCH IN AGRICULTURE', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->Cell(0, 0, 'College, Laguna, 4031, Philippines', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->setFontSize(15);
			$pdf->Cell(0, 10, 'TRAVEL REQUEST', 0, 2, 'C', 0, '', 0, false, 'T', 'B');


			$foot='	<article class="col col-md-12" style="font-size:7px;">

					
					<table style="font-size:10px;">
						<tr>
							<td colspan="3"><hr/></td>
						</tr>
						<tr>
							<td colspan="3">To be prepared in quadruplicate.</td>
						</tr>
						<tr>
							<td>White-Customer </td> <td>Pink - Office/unit</td> <td>Yellow - Accounting</td> <td>Green - Cashier</td>
						</tr>
					</table>
					
				</article>';



		if ($pdf->getPage() <= $pdf->getAliasNumPage()) {
			$pdf->SetY(-30);
			$pdf->Writehtml($foot);
		}



		});

		// Custom Footer
		$pdf->setFooterCallback(function($pdf) {
			//details object
			global $details;

			self::is_creator($details->requested_by);
			

			$pdf->SetY(-50);
			// Set font
	        $pdf->SetFont('helvetica', 'N', 9);

			 $sign = '
				<style>
					
					.withLine{border-bottom:1px solid rgb(20,20,20);overflow:hidden;text-align:left;}
				</style>
					<article>
			<br/><br/>
			
				<table>

				<tr>
						<td></td>
						<td width="160"></td>
						<td><b>Requested By : </b>  </td><td></td>

					</tr>
					<tr>
						<td><div></div></td>
						<td></td>
						<td width="150"><div class="withLine">'.$details->profile_name.'</div></td><td></td>
						<td></td>
						
					</tr>


					<tr>
						<td><b>Approval Recommended</b></td>
						<td width="160"></td>
						<td  width="70"><b>Approved:</b>  </td>
						<td></td>

					</tr>
					<tr>
						<td width="130">
							<div class="withLine" style="border 1px solid rgb(20,20,20);"></div>
						</td>
						<td width="5"></td>
						<td width="50">
							<div class="withLine" ></div>
						</td>
						<td width="100"></td>
						<td width="150"><div class="withLine">'.$details->approved_by.'</div></td>
						<td width="10"></td>
						<td width="50"><div class="withLine"></div></td>
						
					</tr>

					<tr>
						<td width="130">
							<div></div>
						</td>
						<td width="5"></td>
						<td width="50">
							<div style="text-align:center;">Date</div>
						</td>
						<td width="100"></td>
						<td width="150"></td>
						<td width="10"></td>
						<td width="50"><div style="text-align:center;">Date</div></td>
						
					</tr>
					
				</table>

			</article>
			';


			$pdf->Writehtml($sign);

			

			


	        // Position at 15 mm from bottom
	        $pdf->SetY(-15);
	       	$pdf->SetFont('helvetica', 'I', 8);
	        // Page number
	        $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

	         


  	  	});

  	  


		//settings
		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, 50, PDF_MARGIN_RIGHT);

		





    	// create some HTML content
$html ='<style>
			.passenger-table{margin-bottom:20px; }
			.passenger-table td, .passenger-table th{padding: 0; border-right:30px solid #fff;}
			.passenger-table td{}
			.sa-table{margin-bottom:20px; border:3px solid black;}
			.sa-table td,.sa-table th{margin-bottom:20px; border:1px solid rgb(20,20,20);}
			.withLine{border-bottom:1px solid rgb(20,20,20);overflow:hidden;text-align:left;padding-bottom:10px;margin-right:50px;}
		</style>


	<article><br/>

		<table>
			<tr>
				<td width="220"></td><td></td><td class="withLine" style="text-align:center;"  width="100"><b>'.date_format(date_create($details->date_created),'m/d/Y') .'</b></td>
			</tr>
			<tr>
				<td></td><td></td><td style="text-align:center;">Date</td>
			</tr>
			
			
		</table>

	</article>
	
	<article>
		<p><b>I. Passengers</b></p><br/>


		<table class="table passenger-table" id="table-passenger">
			
				<tr>
					<th><b>Name</b></th>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;<b>Designation</b></th>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;<b>Office/Unit</b></th>
				</tr>
			';

#fetch intenerary result
$staff_total_count=count($staff);
$scholars_total_count=count($scholars);
$custom_total_count=count($custom);

$passenger_count=0;

for($a=0;$a<$staff_total_count;$a++){
	$passenger_count++;
	$html.='<tr class="tr-passenger">
			<td class="withLine">'.$staff[$a]->name.'</td>
			<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;'.$staff[$a]->designation.'</td>
			<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;'.$staff[$a]->alias.'</td>
		</tr>';	
}

for($a=0;$a<$scholars_total_count;$a++){
	$passenger_count++;
	$html.='<tr class="tr-passenger">
			<td class="withLine">'.$scholars[$a]->full_name.'</td>
			<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;'.$scholars[$a]->nationality.'</td>
			<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;<i>Scholar</i></td>
		</tr>';	
}

for($a=0;$a<$custom_total_count;$a++){
	$passenger_count++;
	$html.='<tr class="tr-passenger">
			<td class="withLine">'.$custom[$a]->full_name.'</td>
			<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;'.$custom[$a]->designation.'</td>
			<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;<i>N/A</i></td>
		</tr>';	
}


if($passenger_count<4){
	$remaining=5-$passenger_count;

	for($a=0;$a<$remaining;$a++){
		$html.='<tr class="tr-passenger">
				<td class="withLine"></td>
				<td class="withLine"></td>
				<td class="withLine"></td>
			</tr>';	
	}
}




			
		
$html .= '</table>	</article>';

$html.='

	<article>
		<p><b>II. Purpose:</b></p>
		<p class="col col-md-12"><p>'.$details->purpose.'</p></p>
	</article>
	<br/>
	<article>
		<p><b>III. Brief Itenerary:</b></p><br/>
		<table class="table sa-table" style="border:none;">
			<tr>
				<th>Date</th><th>From</th><th>To</th><th>Mode of transport</th><th>Time</th>
			</tr>';

			#fetch intenerary result
			$itenerary_total_count=count($itenerary);

			for($a=0;$a<$itenerary_total_count;$a++){
				$mode_of_transport=$itenerary[$a]->plate_no!='rent_a_car'?'SEARCA Vehicle':'RENT A CAR';
    			$html.='<tr>
					<td>'.$itenerary[$a]->departure_date.'</td>
					<td>'.$itenerary[$a]->location.'</td>
					<td>'.$itenerary[$a]->destination.'</td>
					<td>'.$mode_of_transport.'</td>
					<td>'.$itenerary[$a]->departure_time.'</td>
				</tr>';
    		}


    		#get field remaining to fill up all itenerary
    		$remaining_empty_itenerary=5-$itenerary_total_count;
    		
    		if($remaining_empty_itenerary>0){
    			for($a=0;$a<$remaining_empty_itenerary;$a++){
					$html.='<tr ng-repeat="(key, value) in [0,1,2,3,4,5]" id="travel{{key}}">
							<td><input type="date" class="dateSelector"></td>
							<td><input type="text" class="form-control text"></td>
							<td><input type="text" class="form-control text"></td>
							<td><input type="text" class="form-control text"></td>
							<td><input type="time" class="timeSelector"></td>
							</tr>';
				}
    		}
			
				
    				
					
					

			
			
			

		$html.='</table>
		
	</article>';


$projects='';
for($a=0;$a<count($details->projects);$a++){

	$projects.='<p>'.$details->projects[$a]->project.'</p>';
}



$html.='<br/><br/><br/><article>
		<table>
			<tr>
				<td><b>IV. Cash Advance Requested </b></td><td style="text-align:right;">Source of Fund:</td>
				<td class="withLine"> '.$details->source_of_fund_value.' '.$projects.'</td>
			</tr>
		</table>';

		

$html.='		<table>
			<tr>
				<td></td><td style="text-align:right;"></td><td></td>
			</tr>
		</table>
		
		
		<table><br/>
			
			<tr>
				<td >Per Diems :</td><td> </td><td class="withLine"></td>
			</tr>

			<tr>
				<td>Contingency  :</td><td> </td><td class="withLine"></td>
			</tr>

			<tr>
				<td>Exit Taxes :  </td><td> </td><td class="withLine"></td>
			</tr>

			<tr>
				<td >Others (Pls. Specify)  </td>
				<td class="withLine" width="160"> </td>
				<td width="10"></td>
				<td class="withLine"></td>
			</tr>

			<tr>
				<td>  </td>
				<td class="withLine" width="160"> </td>
				<td width="10"></td>
				<td class="withLine"></td>
			</tr>

			<tr>
				<td><b>Total : </b></td>
				<td width="160"> </td>
				<td width="10"></td>
				<td class="withLine"></td>
			</tr>


		</table>
	</article>

</section>';



		
		$pdf->setFontSize(10);	

		//output
        $pdf->AddPage();
        $pdf->Writehtml($html);
        $pdf->output('Travel Request', 'I');


    }

    

}
