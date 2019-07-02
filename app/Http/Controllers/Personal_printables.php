<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Personal;
use App\Http\Controllers\Personal_itenerary;
use App\Http\Controllers\Personal_staff;
use App\Http\Controllers\Personal_scholars;
use App\Http\Controllers\Personal_custom;
use App\Http\Controllers\Directory;
use App\Http\Controllers\Charge;

use PDF;
session_start();
error_reporting(0);
class Personal_printables extends Controller
{
    
	function is_creator($id){
		if($_SESSION['priv']!='admin'){
			if($id!=@$_SESSION['id']){

				echo '<br/><br/><center><h3>Sorry! File not found.</h3></center>';
				exit;
			}
		}
	}

    function print_travel_request($id){

    

    	#variables
			global $details;
			global $approved_by_checksum;
			global $approved_by_date;
			global $recommended_by_checksum;
			global $recommended_by_date;

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
			
			$approved_by_unique = [];
			$recommended_by_unique = [];

			#var_dump($details->approval[0]);
			foreach($details->approval as $key => $val) {
				if(!isset($approved_by_unique[$val->profile->uid]) && $details->approved_by_uid == $val->profile->uid) {
					$approved_by_unique[$val->profile->uid] = $val;
				}

				if(!isset($recommended_by_unique[$val->profile->uid]) && $details->recommended_by_uid == $val->profile->uid) {
					$recommended_by_unique[$val->profile->uid] = $val;
				}
			}

			$approved_by_checksum ='';
			$approved_by_date = '';
			$recommended_by_checksum ='';
			$recommended_by_date = '';
			if(isset($approved_by_unique[$details->approved_by_uid])) {
				if($approved_by_unique[$details->approved_by_uid]->status) { 
					$approved_by_checksum = $approved_by_unique[$details->approved_by_uid]->checksum;
					$approved_by_date = $approved_by_unique[$details->approved_by_uid]->created_at;
				}
			}

			if(isset($recommended_by_unique[$details->recommended_by_uid])) {
				if($recommended_by_unique[$details->recommended_by_uid]->status) { 
					$recommended_by_checksum = $recommended_by_unique[$details->recommended_by_uid]->checksum;
					$recommended_by_date = $recommended_by_unique[$details->recommended_by_uid]->created_at;
				}
			}


    	//var_dump($details);
    	#get itenerary
    	if(isset($details->tr)){
    		$itenerary=json_decode($official_itenerary->index($details->tr));
    		$staff=json_decode($official_staff->index($details->tr));
    		$scholars=json_decode($official_scholars->index($details->tr));
    		$custom=json_decode($official_custom->index($details->tr));
    		

    	}

    	//vehicle
    	switch($details->vehicle_type){
    		case 1:
    			$vehicle='SUV';
    			break;
    		case 2:
    			$vehicle='Van';
    			break;
    		case 3:
    			$vehicle='Pick-up';
    			break;
    		default:
    			$vehicle='SUV';
    		break;
    	}
    	

    	#var_dump($details);

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
			$pdf->Cell(0, 10, 'TRAVEL REQUEST', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->setFontSize(10);
			$pdf->Cell(0, 0, '(Personal)', 0, 2, 'C', 0, '', 0, false, 'T', 'B');


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

			global $details;
			global $approved_by_checksum;
			global $approved_by_date;
			global $recommended_by_checksum;
			global $recommended_by_date;

			if($approved_by_date) $approved_by_date = @(explode(' ', $approved_by_date))[0];
			if($recommended_by_date) $recommended_by_date = @(explode(' ', $recommended_by_date))[0];

			
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
						<td><b>Approval Recommended:</b></td>
						<td width="157"></td>
						<td  width="70"><b>Approved:</b>  </td>
						<td></td>

					</tr>
					<tr>
						<td></td>
						<td width="160"></td>
						<td  width="70"></td>
						<td></td>

					</tr>
					<tr>
						<td width="130">
							<div>'.($recommended_by_checksum ? '<small>'.$recommended_by_checksum.' ('.$recommended_by_date.')</small><br>': 'VAN ALLEN S. LIMBACO').''.strtoupper($details->recommended_by).'</div>
						</td>
						<td width="5"></td>
						<td width="50">
							
						</td>
						<td width="100"></td>
						<td width="150">'.($approved_by_checksum ? '<small>'.$approved_by_checksum.' <br/>('.$approved_by_date.')</small><br>': '').''.strtoupper($details->approved_by).'</td>
						<td width="10"></td>
						<td width="50"></td>
						
					</tr>

					<tr>
						<td width="130">
							<div>'.($details->recommended_by_position ? $details->recommended_by_position: 'Travel Services Assistant').'</div>
						</td>
						<td width="5"></td>
						<td width="50"></td>
						<td width="100"></td>
						<td width="150">'.ucwords($details->approved_by_position).'</td>
						<td width="10"></td>
						<td width="50"></td>
						
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

		



//var_dump($passenger_custom);
       
//self::is_creator($itenerary->requested_by);

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
			.sa-table td{margin-bottom:20px; border-bottom:1px solid rgb(20,20,20);}
			.sa-table th{margin-bottom:20px; }
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
		<table cellspacing="5">

			<tr>
				<td width="80"><b>Requested By:</b></td>
				<td width="150" class="withLine">'.$details->profile_name.'</td>
				<td width="10"></td>
				<td width="80"><b>Designation :</b></td>
				<td width="150" class="withLine">'.$details->position.'</td>
			</tr>
			<tr>
				<td width="80"><b>Office/Unit:</b></td>
				<td width="150" class="withLine">'.$details->department_alias.'</td>
				<td width="10"></td>
				<td width="80"><b>Destination :</b></td>
				<td width="150" class="withLine">'.$itenerary[0]->destination.'</td>
			</tr>
			<tr>
				<td width="80"><b>Date of trip/time:</b></td>
				<td width="150" class="withLine">'.$itenerary[0]->departure_date.' / '.$itenerary[0]->departure_time.'</td>
				<td width="10"></td>
				<td width="80"><b>From :</b></td>
				<td width="150" class="withLine">'.$itenerary[0]->location.'</td>
			</tr>

			<tr>
				<td width="80"></td>
				<td width="150"></td>
				<td width="10"></td>
				<td width="80"></td>
				<td width="150"></td>
			</tr>

			<tr>
				<td width="80"><b>Type of Vehicle:</b></td>
				<td width="150">'.$vehicle.'</td>
				<td width="10"></td>
				<td width="80"></td>
				<td width="150"></td>
			</tr>
			
		</table>

	</article>';
			
		
$html .= '</article>';

$html.='

	<article>

		<p><b>&nbsp;&nbsp;Purpose:</b></p>

			<table class="table sa-table" style="border:none;" cellspacing="3">
				<tr>
					<td>'.@ucfirst($details->purpose).'</td>
				</tr>
			</table>

	</article>
	<br/>
	<article>
		<p><b>&nbsp;&nbsp;Passengers:</b></p><br/>
		<table class="table sa-table" style="border:none;" cellspacing="5">
			<tr>
				<th><b>Name</b></th><th><b>Designation</b></th><th><b>Office/Unit</b></th>
			</tr>';

			
#fetch intenerary result
$staff_total_count=count($staff);
$scholars_total_count=count($scholars);
$custom_total_count=count($custom);

$passenger_count=0;
$GLOBALS['passenger_names']=array();
$mode_of_payment = $details->mode_of_payment;
#mode of payment
if($mode_of_payment == 'sd') {
	$mode_of_payment = 'Salary Deduction';
}
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



			
		
			

		$html.='</table>
		
	</article>';


	$html.='

	<article>
		<p><b>&nbsp;&nbsp;Charge To: Personal</b></p><br/>
		
	</article>';



$html.='<br/><br/><br/><article>
		<table>
			<tr>
				<td width="30">&nbsp;&nbsp;</td>
				<td width="222" class="withLine"></td>
				<td width="30">&nbsp;&nbsp;</td>
				<td width="222" class="withLine"></td>
			</tr>

			<tr>
				<td width="30">&nbsp;&nbsp;</td>
				<td width="222" style="text-align:center;">Name</td>
				<td width="30">&nbsp;&nbsp;</td>
				<td width="222" style="text-align:center;">Signature</td>
			</tr>


		</table>

		<table>
			<tr>
				<td></td><td style="text-align:right;"></td><td></td>
			</tr>
		</table>
		
		
		
	</article>

</section>';



$html.='<br/><br/><br/><article>
		<table>
			<tr>
				<td width="100"><b>&nbsp;&nbsp;Mode of Payment:</b></td>
				<td width="100" class="withLine">'.@ucwords($mode_of_payment).'</td>
			</tr>
		</table>

		<table>
			<tr>
				<td></td><td style="text-align:right;"></td><td></td>
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



function print_statement_of_account($id){
     	
		global $travel_request;

    	$itenerary=Array();
    	$charges=Array();
    	$staff=Array();
    	$scholars=Array();
    	$custom=Array();


   	

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



    	 $overtime_original=@$charges->overtime/24;
        $overtime=explode('.', $overtime_original);
        $overtime_days=$overtime[0];
        $overtime_hours='0.'.@$overtime[1];
    	$overtime_hours=@($overtime_hours*24);



    	//get default settings from config/laravel-tcpdf.php
   		$pdf_settings = \Config::get('laravel-tcpdf');

   		$pdf = new \Elibyy\TCPDF\TCPDF($pdf_settings['page_orientation'], $pdf_settings['page_units'], array(210,297), true, 'UTF-8', false);
   		


   		// Custom Header
		$pdf->setHeaderCallback(function($pdf) {

			// Title
			// set cell margins
			$pdf->setFontSize(8);
			$pdf->Ln(10);
			$pdf->setFontSize(9);
			//$this->image("../model/img/Logo Searca.png",20,'',15);
			//$this->Cell(0, 0, '<img src="../model/img/Logo Searca.png"/>', 0, 2, 'L', 0, '', 0, false, 'T', 'B');
			//$this->Cell(0, 0, 'Southeast Asian Ministers of Education Organization', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->Cell(0, 0, 'SOUTHEAST ASIAN REGIONAL CENTER FOR GRADUATE STUDY', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->Cell(0, 0, ' AND RESEARCH IN AGRICULTURE', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->Cell(0, 0, 'College, Laguna, 4031, Philippines', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->setFontSize(15);
			$pdf->Cell(0, 10, 'STATEMENT OF ACCOUNT', 0, 2, 'C', 0, '', 0, false, 'T', 'B');


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
		$pdf->SetMargins(PDF_MARGIN_LEFT, 50, PDF_MARGIN_RIGHT);

		
	//prevent other users to view this document
	//self::is_creator($itenerary->requested_by);



    	// create some HTML content
$html ='<style>
			.passenger-table{margin-bottom:20px; }
			.passenger-table td, .passenger-table th{padding: 0; border-right:30px solid #fff;}
			.passenger-table td{}
			.sa-table{margin-bottom:20px; border:3px solid black;}
			.sa-table td,.sa-table th{margin-bottom:20px; border:1px solid rgb(20,20,20);}
			.withLine{border-bottom:1px solid rgb(20,20,20);overflow:hidden;text-align:left;padding-bottom:10px;margin-right:50px;}
		</style>


	<article>

		<table cellspacing="5">

			<tr>
				<td width="80"><b>Requesitioner:</b></td>
				<td width="150" class="withLine">'.$travel_request->profile_name.'</td>
				<td width="10"></td>
				<td width="80"><b></b></td>
				<td width="150" style="font-weight:bold;font-size:12px;font-style:italic;color:gray;"> <b>No. '.$travel_request->id.'</b></td>
			</tr>
			<tr>
				<td width="150"><b>Office/Unit/Program/Project :</b></td>
				<td width="150" class="withLine">'.($travel_request->department_alias ? $travel_request->department_alias : 'N/A').'</td>
				<td width="10"></td>
				<td width="10"><b></b></td>
				<td width="150" class="withLine" align="center"><b>'.date('F d, Y') .'</b></td>
			</tr>

			<tr>
				<td width="150"></td>
				<td width="150"></td>
				<td width="10"></td>
				<td width="10"></td>
				<td width="150" style="text-align:center;">Date</td>
			</tr>
			
			
		</table>


	</article>';

$html.='
	<br/><br/><br/>
	<article>
		<table class="table sa-table" style="border:none;">
			<tr>
				<th><b>Description</b></th>
				<th><b>Amount</b></th>
			</tr>';

			
			
					
			$html.='<tr>
				<td height="100"><br/>
				<p>'.$itenerary->location.' - '.$itenerary->destination.'</p>
				<br/><br/>
					<b>Note:</b> Php '.@number_format($charges->gasoline_charge, 2, '.', ',').' (base '.@$charges->base.' km) <br/>
				';
				
				if(strlen(@$charges->notes)>1){
				 
				 	$html.='<br/>Advance Charging : <b>'.@$charges->notes.'</b>';
				 }

				$html.='	
				</td>


				<td><br/><br/>
					<b>Php '.@$charges->gasoline_charge.'</b><br/><br/>
					<b>Charge :</b> Php '.$charges->gasoline_charge.'<br/>
					<b>Additional Charge:</b> Php '.@$charges->additional_charge.'<br/>
					<b>Over time :</b> '.@$overtime_days.' day(s) and '.@$overtime_hours.' hour(s)<br/>
					<b>Driver\'s Overtime Charge:</b> Php '.@number_format($charges->drivers_charge, 2, '.', ',').'<br/>
				</td>
				
			</tr>';
			$html.='<tr>
				<td><input type="date" class="dateSelector"><b>Received by: </b></td>
				<td><input type="text" class="form-control text"><b>TOTAL : Php '.@number_format($charges->total, 2, '.', ',').'</b></td>
				
			</tr>';
			$html.='<tr>
				<td><br/><br/><br/><br/>
					<b>IMPORTANT:</b> This statement is presumed correct unless otherwise notified within 7 days after date of receipt

					<p>Prepared by: Van-Allen s. Limbaco</p>
					<p>Reference: Transport Service Assistant</p><br/><br/>

				</td>
				<td>
					<br/><br/>
					<p><b>Certified Correct:</b></p>
					<p>Payment not yet received</p><br/><br/>
					<b>RICARDO A. MENORCA</b><br/>
					HEAD, GSU
					<br/><br/>

				</td>
				
			</tr>';

		$html.='</table>
		
	</article>';

$html.='</section>';



		
		$pdf->setFontSize(10);	

		//output
        $pdf->AddPage();
        $pdf->Writehtml($html);
        $pdf->output('Travel Request', 'I');


    }

}
