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
    	

    	



    	//get default settings from config/laravel-tcpdf.php
   		$pdf_settings = \Config::get('laravel-tcpdf');

   		$pdf = new \Elibyy\TCPDF\TCPDF($pdf_settings['page_orientation'], $pdf_settings['page_units'], array(210,297), true, 'UTF-8', false);
   		


   		// Custom Header
		$pdf->setHeaderCallback(function($pdf){

			//details object
			global $details;
		

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
			$pdf->Cell(0, 10, 'CAMPUS TRAVEL REQUEST', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->setFontSize(10);
			$pdf->Cell(0, 0, '(For trips within 15 km. radius from SEARCA Headquarter)', 0, 2, 'C', 0, '', 0, false, 'T', 'B');


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

			//designation
			$details->approved_by_position=!empty($details->approved_by_position)?$details->approved_by_position:'HEAD, Motor Pool Unit';

			$pdf->SetY(-70);
			// Set font
	        $pdf->SetFont('helvetica', 'N', 9);

			 $sign = '
				<style>
					
					.withLine{border-bottom:1px solid rgb(20,20,20);overflow:hidden;text-align:left;}
					.passenger-table, .passenger-table tr td{padding: 0; border-right:30px solid #fff;}

				</style>
			<article>
				<br/><br/>
			
				<table>

					<tr>
						<td><b>Recommending Approval:</b></td>
						<td width="160"></td>
						<td  width="70"><b>Approved:</b></td>
						<td></td>

					</tr>

					<tr>
						<td width="180">
							<div class="withLine" style="border 1px solid rgb(20,20,20);text-align:center;">'.$details->recommended_by.'</div>
						</td>
						<td width="5"></td>
						
						<td width="100"></td>
						<td width="180">
							<div class="withLine" style="border 1px solid rgb(20,20,20);text-align:center;">'.$details->approved_by.'</div>
						</td>
						<td width="10"></td>
						<td width="50"></td>
						
					</tr>

					
				</table>

				<table cellpadding="-5">

					<tr cellpadding="-5">
						<td  width="180" style="text-align:center;"><b>Unit/Office Head</b></td>
						<td width="160"></td>
						<td  width="90" style="text-align:center;"><b>'.$details->approved_by_position.'</b></td>
					

					</tr>
					
				</table>
					<br/><br/><br/><br/>
					<p style="font-size:7px;">
						<label>NOTE:</label> PREPARE ONE DUPLICATE COPY IF TRIP IS BY <u>SEARCA VEHICLE:</u> <label>Original-</label> Unit concerned; <label>Duplicate-</label> Security Guard<br/>
					*Should be indicated per trip <br/>
					 *If the trip is by SEARCA service vehicle, recommendation for approval of requisitioner\'s immediate superior and corresponding approval of the Head of the General Services Unit<br/>
					Unit are required under the appropriate columns.</p>



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

		
		$projects='';
		for($a=0;$a<count($details->projects);$a++){

			$projects.='<p>'.$details->projects[$a]->project.'</p>';
		}


//prevent other users to view this document
	//self::is_creator($travel_request->requested_by);

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
					<td  width="98"><b>Requesting Party : </b></td>
					<td  width="180" class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;'.$details->profile_name.'</td>
					<td  width="30" ></td>
					<td  width="70"><b>Unit/Office:</b></td>
					<td  width="120"  class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;'.$details->department_alias.'</td>
				</tr>
				<tr>
					<td  width="98"><b>Date(s) : </b></td>
					<td  width="180" class="withLine"></td>
					<td  width="30" ></td>
					<td  width="70"><b>Charge To:</b></td>
					<td width="130"  class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;'.$details->source_of_fund_value.' '.$projects.'</td>
				</tr>
				<tr>
					<td  width="98"><b>Time : </b></td>
					<td  width="180" class="withLine"></td>
					<td  width="30" ></td>
					<td  width="70"> </td>
					<td  width="120"></td>
				</tr>
		</table>
		
	</article>

			';

$html.='

	<br/>
	<article>
		<p><b>Purpose :</b></p>
		<p class="withLine">'.@ucfirst($details->purpose).'</p><br/>
	</article>';


$html.='

	<p></p><p></p>
	<article>
		<p><b>Passengers :</b></p><br/>
	</article>';


$html.='
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

		
		$html .= '</table>';

$html.='

	<article>
		<p><b>Travel(s)</b></p><br/>
		<table class="table sa-table" style="border:none;">
			<tr>
				<th>Date</th><th>From</th><th>To</th><th>Time</th>
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
					$html.='<tr>
								<td><input type="date" class="dateSelector"></td>
								<td><input type="text" class="form-control text"></td>
								<td><input type="text" class="form-control text"></td>
								<td><input type="text" class="form-control text"></td>
								<td><input type="time" class="timeSelector"></td>
							</tr>';
				}
    		}
			
			

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
				<td width="400"></td><td></td><td width="100"><b>NO. '.$itenerary->id.'</b><br/></td>
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
					<b>'.$itenerary->location.' - '.$itenerary->destination.'</b>';


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
					<b>Conforme:</b><br/><br/>
					<b>'.$travel_request->recommended_by.'</b><br/>
					'.$travel_request->recommended_by_position.'<br/>

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
