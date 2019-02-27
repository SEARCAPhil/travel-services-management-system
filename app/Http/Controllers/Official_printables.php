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
			#hack to be able to view the PDF
			if($id!=@$_SESSION['uid']&&$id!=@$_SESSION['id']){

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
			$source_of_funds = [
				'opf' => 'Operating Funds',
				'otf' => 'Other Funds',
				'op' => 'Obligations Payable',
				'sf' => 'Special Funds',
				'opfs' => 'Operating Funds (Scholars)',
				'otfs' => 'Other Funds (Scholars)'
			];


   	

    	#get data
    	$official_itenerary=new Official_itenerary();
    	$official_travel=new Official();
    	$charge_travel=new Charge();

    	$GLOBALS['official_travel']=$official_travel;

    	$official_staff=new Official_staff();
    	$official_scholars=new Official_scholars();
    	$official_custom=new Official_custom();



    	$itenerary=@json_decode($official_itenerary->show($id))[0];
    	$charges=@json_decode($official_itenerary->show_charges($id))[0];
    	$travel_request=@json_decode($official_travel->show($itenerary->tr_id))[0];



    	$staff=json_decode($official_staff->index($itenerary->tr_id));
    	$scholars=json_decode($official_scholars->index($itenerary->tr_id));
    	$custom=json_decode($official_custom->index($itenerary->tr_id));

    	$fundings = @json_decode($official_travel->get_fundings($itenerary->tr_id));

    	


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
				<td width="220"></td><td></td><td width="100" style="text-align:right;font-weight:bold;font-size:12px;font-style:italic;color:gray;"><b>&nbsp;NO. '.$id.'&nbsp;</b>&nbsp;</td>
			</tr>

			
		</table>
		<br/>

	</article>';

    	// create some HTML content
$html .='<style>

			.sa-table{margin-bottom:20px; border:1px solid rgb(80,80,80);}
			.sa-table td{margin-bottom:20px; border:1px solid rgb(80,80,80);}
			.withLine{border-bottom:1px solid rgb(20,20,20);overflow:hidden;text-align:left;padding-bottom:10px;margin-right:50px;}
		</style>


	<article>


		<br/>

		<table>
			<tr>
				<td width="220"></td><td></td><td class="withLine" style="text-align:center;"  width="100"><b>'.date('F d, Y').'</b></td>
			</tr>
			<tr>
				<td></td><td></td><td style="text-align:center;"><b>Date</b></td>
			</tr>

			
		</table>

	</article>';
$adf_no= '';
$service_station = '';
foreach($itenerary->gasoline_records as $key => $value) {
	$adf_no.=$value->id.' ' ;
	$service_station.=$value->station.' ';
}	
$html.='	<article class="col col-md-12">
		<table class="table table-bordered sa-table "  style="font-size:0.8em;" cellspacing="0">
			<tr class="mini-tr">
				<td>
					<p> <input type="checkbox" checked="checked"/>UPLB and Vicinity</p>
					<p> <input type="radio">Out-of-town</p> 

				</td>
				<td>
					<p><label> <b>ADS # : '.$adf_no.'</b></label> <span> </span></p>
					
				</td>				
			</tr>


			<!--requesting party-->
			<tr>
				<td> Requesting Party : <b>'.$travel_request->profile_name.'</b></td>

				<td> Source of fund:  '; 

			$f='';
			
			for($x=0;$x<count($fundings);$x++){
				$f.='<br/><b>'.(isset($source_of_funds[$fundings[$x]->fund]) ? $source_of_funds[$fundings[$x]->fund] : $fundings[$x]->fund).' - '.$fundings[$x]->cost_center.' - '.$fundings[$x]->line_item.'</b>';
			}	

			$html.=$f;

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
								<th><b>Designation</b></th>
								<th><b>Office/Unit</b></th>
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
				<td class="withLine">'.$staff[$a]->designation.'</td>
				<td class="withLine">'.$staff[$a]->alias.'</td>
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
				<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;</td>
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

	/*------------------------------------------
	| TEMPORARY FIX FOR OVERRIDING SIGNATORIES
	|
	|-------------------------------------------*/

	$approved_by = isset($_GET['approved_by'])?htmlentities(htmlspecialchars($_GET['approved_by'])):'Ricardo A. Menorca';
	$approved_by_position = isset($_GET['position'])?htmlentities(htmlspecialchars($_GET['position'])):'Unit head,General Services';




		$dt = new \DateTime($itenerary->actual_departure_time);
		$rt = new \DateTime($itenerary->returned_time);
		$deptTime = new \DateTime($itenerary->departure_time);
		$isEmptyDeptTime = $itenerary->departure_time == '00:00:00' ? true : false; 
		$isEmptyReturnedTime = $itenerary->returned_time == '00:00:00' ? true : false; 						
		$isEmptyRetDate = $itenerary->returned_date == '0000-00-00' ? true : false;
		$isEmptyActualDeptTime = $itenerary->actual_departure_time == '00:00:00' ? true : false; 

		$itenerary_departure_date_formatted = (@new \DateTime($itenerary->departure_date))->format('F d, Y');
		$itenerary_arrival_date_formatted = (@new \DateTime($itenerary->returned_date))->format('F d, Y');

		$html .= '</table><br/><br/>';

			$html .= '	</td>
				<td> Purposes/Places to be visited: <b>'.htmlspecialchars(nl2br($travel_request->purpose)).'</b>
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
							<td style="border-right:1px solid rgb(80,80,80);border-bottom:1px solid rgb(80,80,80);" width="100"> <b>'.$itenerary_departure_date_formatted.'</b></td>
							<td style="border-bottom:1px solid rgb(80,80,80);" width="67"> <b>'.($isEmptyDeptTime ? '' : $deptTime->format('h:i A')).'</b> </td>
						</tr>
						<tr style="border:none;">
							<td style="border-right:1px solid rgb(80,80,80);border-bottom:1px solid rgb(80,80,80);" width="80">Arrival</td>
							<td style="border-right:1px solid rgb(80,80,80);border-bottom:1px solid rgb(80,80,80);" width="100"> <b>'.($isEmptyRetDate  ? '' : $itenerary_arrival_date_formatted).'</b></td>
							<td style="border-bottom:1px solid rgb(80,80,80);" width="67"> <b>'.($isEmptyReturnedTime ? '' : $rt->format('h:i A')).'</b></td>
						</tr>
					</table>

				</td>

			</tr>


			<!--Vehicle Plate-->
			<tr>
				<td> Vehicle/Plate no.:  <b>'.@$itenerary->manufacturer.'</b> <b>'.@$itenerary->plate_no.'</b>
			
				</td>
				<td> Assigned Driver: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'.@$itenerary->profile_name.'</b> </td>

			</tr>


			<!--station-->
			<tr>
				<td> Service Station.: '.$service_station.'
			
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
						 	<td><b>'.strtoupper($approved_by).'</b></td>
						 </tr>
						 <tr>
						 	<td><p>'.$approved_by_position.'</p></td>
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
				<table cellspacing="10">
					<tr>
						<td width="60">Date</td>
						<td width="80"><b>'.$itenerary_departure_date_formatted.'</b></td>
						<td><b>'.($isEmptyRetDate ? '' :$itenerary_arrival_date_formatted).'</b></td>
					</tr>
					<tr>
						<td width="60">Time</td>
						<td width="80"><b>'.($isEmptyActualDeptTime ? '' :$dt->format('h:i A')).'</b></td>
						<td><b>'.($isEmptyReturnedTime ? '' : $rt->format('h:i A')).'</b></td>
					</tr>
					<tr>
						<td width="60">Mileage Reading</td>
						<td width="80">'.@$charges->start.'</td>
						<td>'.@$charges->end.'</td>
					</tr>
					<tr>
						<td width="60">Signature of driver</td>
						<td width="80"></td>
						<td></td>
					</tr>
					<tr>
						<td width="60">Attested by;</td>
						<td width="80"></td>
						<td></td>
					</tr>
					<tr>
						<td width="60">Guard-on-duty</td>
						<td width="80"></td>
						<td></td>
					</tr>
				</table>
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
				 &nbsp; No. of kms. : <b>'.@($charges->end-$charges->start).' kms </b><br/>
				 &nbsp; Rate/km : <b>PHP '.@number_format($charges->gasoline_charge, 2, '.', ',').'</b><br/>
				 &nbsp;Amount : <b>PHP '.@number_format($charges->total, 2, '.', ',').'</b><br/>  
				 ';

				 if(strlen(@$charges->notes)>1){
				 	$html.='<br/><p style="font-size:6px;"><b>NOTE :</b> '.@ucfirst($charges->notes).'</p>';
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
    
    	$GLOBALS['official']=$official;

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
    	

    	$fundings = @json_decode($official->get_fundings($id));
    	



    	
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
			

			$pdf->SetY(-57);
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
						<td><b>Requested By : </b><br/>  </td><td></td>

					</tr>
					<tr>
						<td><div></div></td>
						<td></td>
						<td width="150"><div class="withLine">'.$details->profile_name.'</div></td><td></td>
						<td></td>
						
					</tr>


					<tr>
						<td><br/><br/><b>Approval Recommended</b><br/></td>
						<td width="160"></td>
						<td  width="70"><br/><br/><b>Approved:</b>  </td>
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
		$pdf->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);

		



    	// create some HTML content
$html ='<style>

			.sa-table{margin-bottom:20px; border:1px solid rgb(80,80,80);}
			.sa-table td{margin-bottom:20px; border:1px solid rgb(80,80,80);}
			.withLine{border-bottom:1px solid rgb(20,20,20);overflow:hidden;text-align:left;padding-bottom:10px;margin-right:50px;}
		</style>


	<article>

		<table>
			<tr>
				<td width="220"></td><td></td><td width="100" style="text-align:right;font-weight:bold;font-size:12px;font-style:italic;color:gray;"><b>&nbsp;NO. '.$id.'&nbsp;</b>&nbsp;</td>
			</tr>

			
		</table>
		<br/>

	</article>';


    	// create some HTML content
$html .='<style>
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
				<td width="220"></td><td></td><td class="withLine" style="text-align:center;"  width="100"><b>'.date('m/d/Y').'</b></td>
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
$GLOBALS['passenger_names']=array();
for($a=0;$a<$staff_total_count;$a++){
	array_push($GLOBALS['passenger_names'], $staff[$a]->name);

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

	#prevent too long designation
	if(strlen($custom[$a]->designation)>=32){
		$custom[$a]->designation=substr($custom[$a]->designation, 0,28).'...';
	}
		
	$passenger_count++;
	$html.='<tr class="tr-passenger">
			<td class="withLine">'.$custom[$a]->full_name.'</td>
			<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;'.$custom[$a]->designation.'</td>
			<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
		<p class="col col-md-12"><p>'.nl2br($details->purpose).'</p></p>
	</article>
	<br/>
	<article>
		<p><b>III. Brief Itinerary:</b></p><br/>
		<table class="table sa-table" style="border:none;">
			<tr>
				<th>Date</th><th>From</th><th>To</th><th>Mode of transport</th><th>Time</th>
			</tr>';

			#fetch intenerary result
			$itenerary_total_count=count($itenerary);

			for($a=0;$a<$itenerary_total_count;$a++){
				$mode_of_transport=$itenerary[$a]->plate_no!='rent_a_car'?'SEARCA Vehicle':'RENT A CAR';
				$dt = new \DateTime($itenerary[$a]->departure_time);
				$isEmptyDeptTime = $itenerary[$a]->departure_time == '00:00:00' ? true : false;
    			$html.='<tr>
					<td>'.@date_format(date_create($itenerary[$a]->departure_date),'m-d-y').'</td>
					<td>'.$itenerary[$a]->location.'</td>
					<td>'.html_entity_decode($itenerary[$a]->destination).'</td>
					<td>'.$mode_of_transport.'</td>
					<td>'.(is_null($itenerary[$a]->departure_time) || $isEmptyDeptTime ? '' : $dt->format('h:i A')).'</td>
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


$f='';
$source_of_funds = [
	'opf' => 'Operating Funds',
	'otf' => 'Other Funds',
	'op' => 'Obligations Payable',
	'sf' => 'Special Funds',
	'opfs' => 'Operating Funds (Scholars)',
	'otfs' => 'Other Funds (Scholars)'
];

for($x=0;$x<count($fundings);$x++){ 
	$f.='<b style="font-size:8px;"> '.(isset($source_of_funds[$fundings[$x]->fund]) ? $source_of_funds[$fundings[$x]->fund] : $fundings[$x]->fund).' - '.$fundings[$x]->cost_center.' - '.$fundings[$x]->line_item.''.(count($fundings)>0&&count($fundings)>$x+1?',':'').'</b><br/>';
}	




$html.='<br/><br/><br/><article>
		<table>
			<tr>
				<td><b>IV. Cash Advance Requested </b></td><td style="text-align:right;">Source of Fund:</td>';

				$html.='<td class="withLine">';
				$html.=$f;
				$html.='</td>';
			

		$html.='</tr>
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
$notes = nl2br($details->purpose); 

$notePage = "<br/><h4>Notes</h4><hr/>${notes}";



		
		$pdf->setFontSize(10);	

		//output
		$pdf->AddPage();
		$pdf->Writehtml($html);
		

		$pdf->AddPage();
		$pdf->Writehtml($notePage);
		$pdf->output('Travel Request', 'I');


    }

    

}
