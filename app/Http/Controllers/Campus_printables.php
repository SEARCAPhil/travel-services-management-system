<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Campus;
use App\Http\Controllers\Campus_itenerary;
use App\Http\Controllers\Charge;

use PDF;

session_start();

error_reporting(0);
class Campus_printables extends Controller
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

			$pdf->Cell(0, 10, 'CAMPUS TRAVEL REQUEST', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->Cell(0, 0, '(For trips within 20 km. radius from SEARCA Headquarter)', 0, 2, 'C', 0, '', 0, false, 'T', 'B');


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

			$pdf->SetY(-120);
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
						<td><b>Approval Recommended</b></td>
						<td width="160"></td>
						<td  width="70">  </td>
						<td></td>

					</tr>

					<tr>
						<td width="230">
							<div class="withLine" style="border 1px solid rgb(20,20,20);"></div>
						</td>
						<td width="5"></td>
						<td width="50"></td>
						<td width="100"></td>
						<td width="150"></td>
						<td width="10"></td>
						<td width="50"></td>
						
					</tr>
					
				</table>
					<br/><br/><br/><br/>
					<p>
						<label>NOTE:</label> PREPARE ONE DUPLICATE COPY IF TRIP IS BY <u>SEARCA VEHICLE:</u> <label>Original-</label> Unit concerned; <label>Duplicate-</label> Security Guard</p><br/>
					<p>*Should be indicated per trip</p><br/>
					<p>*If the trip is by SEARCA service vehicle, recommendation for approval of requisitioner\'s immediate superior and corresponding approval of the Head of the Facilities Management</p>
					<p> Unit are required under the appropriate columns.</p>



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

		

	#get data
	$campus_itenerary=new Campus_itenerary();
	$campus_travel=new Campus();
	

	$travel_request=@json_decode($campus_travel->show($id))[0];

	$itenerary=@json_decode($campus_itenerary->index($id))[0];
	
	

//prevent other users to view this document
	self::is_creator($travel_request->requested_by);

    	// create some HTML content
$html ='<style>
			.passenger-table{margin-bottom:20px; }
			.passenger-table td, .passenger-table th{padding: 0; border-right:30px solid #fff;}
			.passenger-table td{}
			.sa-table{margin-bottom:20px; border:3px solid black;}
			.sa-table td,.sa-table th{margin-bottom:20px; border:1px solid rgb(20,20,20);}
			.withLine{border-bottom:1px solid rgb(20,20,20);overflow:hidden;padding-bottom:10px;}
		</style>


	<article><br/>
		<table class="table passenger-table" id="table-passenger">
			
				<tr>
					<th width="90"><b>Requesitioner : </b></th>
					<th width="280">'.$travel_request->profile_name.'</th>
					<th class="withLine" width="120" style="text-align:center;">&nbsp;<b> '.date_format(date_create($travel_request->date_created),'m/d/Y').'</b></th>
				</tr>
				<tr>
					<th width="150"><b>Office/Unit/Program/Project :</b></th>
					<th width="270">'.$travel_request->department.'</th>
					<th width="100">Date</th>
				</tr>
		</table>
		
	</article>

			';




$html.='

	<article>
		<p><br/><br/></p>
		<p class="col col-md-12"><p></p></p>
	</article>
	<br/>
	<article>
		<p><b>Travel(s)</b></p><br/>
		<table class="table sa-table" style="border:none;">
			<tr>
				<th>Date</th><th>From</th><th>To</th><th>Time</th>
			</tr>';

			
					
					
			$html.='<tr ng-repeat="(key, value) in [0,1,2,3,4,5]" id="travel{{key}}">
				<td>'.$itenerary->departure_date.'</td>
				<td>'.$itenerary->location.'</td>
				<td>'.$itenerary->destination.'</td>
				<td>'.$itenerary->departure_time.'</td>
			</tr>';

			$html.='<tr ng-repeat="(key, value) in [0,1,2,3,4,5]" id="travel{{key}}">
				<td><input type="date" class="dateSelector"></td>
				<td><input type="text" class="form-control text"></td>
				<td><input type="text" class="form-control text"></td>
				<td><input type="time" class="timeSelector"></td>
			</tr>';
			$html.='<tr ng-repeat="(key, value) in [0,1,2,3,4,5]" id="travel{{key}}">
				<td><input type="date" class="dateSelector"></td>
				<td><input type="text" class="form-control text"></td>
				<td><input type="text" class="form-control text"></td>
				<td><input type="time" class="timeSelector"></td>
			</tr>';
			$html.='<tr ng-repeat="(key, value) in [0,1,2,3,4,5]" id="travel{{key}}">
				<td><input type="date" class="dateSelector"></td>
				<td><input type="text" class="form-control text"></td>
				<td><input type="text" class="form-control text"></td>
				<td><input type="time" class="timeSelector"></td>
			</tr>';
			$html.='<tr ng-repeat="(key, value) in [0,1,2,3,4,5]" id="travel{{key}}">
				<td><input type="date" class="dateSelector"></td>
				<td><input type="text" class="form-control text"></td>
				<td><input type="text" class="form-control text"></td>
				<td><input type="time" class="timeSelector"></td>
			</tr>';
			$html.='<tr ng-repeat="(key, value) in [0,1,2,3,4,5]" id="travel{{key}}">
				<td><input type="date" class="dateSelector"></td>
				<td><input type="text" class="form-control text"></td>
				<td><input type="text" class="form-control text"></td>
				<td><input type="time" class="timeSelector"></td>
			</tr>';
			
			

		$html.='</table>
		
	</article><br/><br/><br/>';

$html.='

</section>';



		
		$pdf->setFontSize(10);	

		//output
        $pdf->AddPage();
        $pdf->Writehtml($html);
        $pdf->output('Travel Request', 'I');


    }



function print_notice_of_charges($id){

	
	#get data
	$campus_itenerary=new Campus_itenerary();
	$campus_travel=new Campus();
	$charge_computation_module=new Charge();



	$itenerary=@json_decode($campus_itenerary->show($id))[0];
	$charges=@json_decode($campus_itenerary->show_charges($id))[0];
	$travel_request=@json_decode($campus_travel->show($itenerary->trc_id))[0];


/*
	$gasoline_charge=$charge_computation_module->calculate_gasoline_charge($charges->base,$charges->end-$charges->start,$charges->gasoline_charge,$default_rate='25');
	

	if($charges->appointment=='emergency'){
		$drivers_charge=($charge_computation_module->calculate_emergency_drivers_charge($itenerary->departure_date,$itenerary->departure_time,$itenerary->returned_date,$itenerary->returned_time,$charges->drivers_charge));
	}else{
		$drivers_charge=($charge_computation_module->calculate_contracted_drivers_charge($itenerary->departure_date,$itenerary->departure_time,$itenerary->returned_date,$itenerary->returned_time,$charges->drivers_charge,$charges->days));
	}

	$overall_gasoline_charge=@array_sum($gasoline_charge);
	$overall_charge=$overall_gasoline_charge+$drivers_charge;
*/







    	//get default settings from config/laravel-tcpdf.php
   		$pdf_settings = \Config::get('laravel-tcpdf');

   		$pdf = new \Elibyy\TCPDF\TCPDF('L', $pdf_settings['page_units'], array(210,297), true, 'UTF-8', false);
   		


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
			$pdf->Cell(0, 10, 'NOTICE OF CHARGES', 0, 2, 'C', 0, '', 0, false, 'T', 'B');



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
	self::is_creator($travel_request->requested_by);


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

		<table>
			<tr>
				<td width="400"></td><td></td><td width="100"><b>NO. '.$itenerary->trc_id.'</b><br/></td>
			</tr>

			
		</table>
		<br/>

		<table>
			<tr>
				<td width="400"></td><td></td><td class="withLine" style="text-align:center;"  width="100"><b>'.date_format(date_create($itenerary->date_created),'m/d/Y') .'</b></td>
			</tr>
			<tr>
				<td></td><td></td><td style="text-align:center;"><b>Date</b><br/></td>
			</tr>

			
		</table>

	</article>
	<article>

		<table cellspacing="5">

			<tr>
				<td width="50"><b>To: </b></td>
				<td width="250" class="withLine">'.$travel_request->profile_name.'</td>
				<td width="140"></td>
				<td width="40"><b>Office:</b></td>
				<td width="250" class="withLine">'.$travel_request->department.'</td>
			</tr>
			<tr>
				<td width="50"><b>For:</b></td>
				<td width="250" class="withLine"></td>
				<td width="140"></td>
				<td width="40"><b>Month:</b></td>
				<td width="250" class="withLine">'.date_format(date_create($itenerary->date_created),'F') .'</td>
			</tr>

			
			
			
		</table>


	</article>';

$html.='
	<br/><br/><br/>
	<article>
		<table class="table sa-table" style="border:none;">
			<tr>
				<th><b>Date</b></th>
				<th><b>Description</b></th>
				<th><b>Amount</b></th>
			</tr>';

			
					
					
			$html.='<tr>
				<td></td>
				<td height="60">
				<br/><br/>
					<b>Total:</b>';


					if(strlen(@$charges->notes)>1){
					 
					 	$html.='<p>Advance Charging : <b>'.@ucfirst($charges->notes).'</b><br/></p>';
					 }


					$html.='
				</td>


				<td><br/><br/>
					<b>Php '.@number_format(round($charges->total,2)).'</b><br/><br/>
					
				</td>
				
			</tr>';

			$html.='<tr>
				<td><br/><br/>
					

					Prepared by:<br/><br/>
					<b>VAN-ALLEN S. LIMBACO</b><br/>
					Transport Service Assistant<br/><br/>

				</td>
				<td>
					<br/><br/>
					<b>Certified By:</b><br/><br/>
					<b>RICARDO A. MENORCA</b><br/>
					HEAD, GSU
					<br/><br/>

				</td>

				<td>
					<br/><br/>
					<b>Conforme:</b>

				</td>
				
			</tr>';

		$html.='</table>
		
	</article>';

$html.='</section>';



		
		$pdf->setFontSize(10);	

		//output
        $pdf->AddPage('L');
        $pdf->Writehtml($html);
        $pdf->output('Travel Request', 'I');


    }
}
