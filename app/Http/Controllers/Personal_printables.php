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

    	#get data
    	$personal_travel=new Personal();
     	$itenerary=@json_decode($personal_travel->show($id))[0];
     	$GLOBALS['itenerary']=$itenerary;
     	$GLOBALS['personal']=$personal_travel;

     	//var_dump($itenerary);

     	 //passengers
        $passenger_staff_class=new Personal_staff();
        $passenger_scholar_class=new Personal_scholars();
        $passenger_custom_class=new Personal_custom();


        $passenger_staff=json_decode($passenger_staff_class->index($itenerary->id));
        $passenger_scholar=json_decode($passenger_scholar_class->index($itenerary->id));
        $passenger_custom=json_decode($passenger_custom_class->index($itenerary->id));

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

			$approver_designation="Head, GSU";

			$GLOBALS['itenerary']->approved_by=is_null($GLOBALS['itenerary']->approved_by)?'Ricardo A. Menorca':$GLOBALS['itenerary']->approved_by;

			//override approved by if approver is one of the passengers
	        //// HACK!!!!!!!!!!!!!!!!! eeew
	        if(in_array(@$GLOBALS['itenerary']->approved_by,$GLOBALS['passenger_names'])){
	        	//head GSU
	        	$approver='Ricardo A. Menorca';
				$approver_designation="Head, GSU";

				//ODDA
	   			$approver_odda='Adoracion T. Robles';
	   			$approver_designation_odda="Head, ODDA";

	   			//director
	   			$approver_director='Gil C. Saguiguit Jr.';
	   			$approver_designation_director="SEARCA Director";


				if($GLOBALS['itenerary']->approved_by==$approver){
					$approver=$approver_odda;
					$approver_designation=$approver_designation_odda;
					//update
					$GLOBALS['personal']->update_signatory($GLOBALS['itenerary']->id,$approver);
				}elseif($GLOBALS['itenerary']->approved_by==$approver_odda){
					$approver=$approver_director;
					$approver_designation=$approver_designation_director;

					$GLOBALS['personal']->update_signatory($GLOBALS['itenerary']->id,$approver);

				}elseif($GLOBALS['itenerary']->approved_by==$approver_director){
					$approver=$approver_odda;
					$approver_designation=$approver_designation_odda;
					//update
					$GLOBALS['personal']->update_signatory($GLOBALS['itenerary']->id,$approver);
				}else{
						
				}

	        	
	        }else{
				
			
	        	//head GSU
	        	$approver=(empty($GLOBALS['itenerary']->approved_by))||(is_null($GLOBALS['itenerary']->approved_by))?'Ricardo A. Menorca':$GLOBALS['itenerary']->approved_by;
				
	
	        }


	      


			
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
							<div>VAN ALLEN S. LIMBACO</div>
						</td>
						<td width="5"></td>
						<td width="50">
							
						</td>
						<td width="100"></td>
						<td width="150">'.strtoupper($approver).'</td>
						<td width="10"></td>
						<td width="50"></td>
						
					</tr>

					<tr>
						<td width="130">
							<div>Travel Services Assistant</div>
						</td>
						<td width="5"></td>
						<td width="50"></td>
						<td width="100"></td>
						<td width="150">'.$approver_designation.'</td>
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
       
self::is_creator($itenerary->requested_by);

    	// create some HTML content
$html ='<style>
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
				<td width="220"></td><td></td><td class="withLine" style="text-align:center;"  width="100"><b>'.date_format(date_create($itenerary->date_created),'m/d/Y') .'</b></td>
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
				<td width="150" class="withLine">'.$itenerary->profile_name.'</td>
				<td width="10"></td>
				<td width="80"><b>Designation :</b></td>
				<td width="150" class="withLine">'.ucfirst($itenerary->position).'</td>
			</tr>
			<tr>
				<td width="80"><b>Office/Unit:</b></td>
				<td width="150" class="withLine">'.$itenerary->department.'</td>
				<td width="10"></td>
				<td width="80"><b>Destination :</b></td>
				<td width="150" class="withLine">'.$itenerary->destination.'</td>
			</tr>
			<tr>
				<td width="80"><b>Date of trip/time:</b></td>
				<td width="150" class="withLine">'.$itenerary->departure_date.' / '.$itenerary->departure_time.'</td>
				<td width="10"></td>
				<td width="80"><b>From :</b></td>
				<td width="150" class="withLine">'.$itenerary->location.'</td>
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
				<td width="150">'.$itenerary->class.'</td>
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

			<table class="table" style="border:none;" cellspacing="3">
			<tr>
				<td>'.$itenerary->purpose.'</td>
			</tr></table>

	</article>
	<br/>
	<article>
		<p><b>&nbsp;&nbsp;Passengers:</b></p><br/>
		<table class="table sa-table" style="border:none;" cellspacing="5">
			<tr>
				<th><b>Name</b></th><th><b>Designation</b></th><th><b>Office/Unit</b></th>
			</tr>';

			$total_passenger=0;
			$GLOBALS['passenger_names']=array();

	

			for($x=0;$x<count($passenger_staff);$x++) {
				array_push($GLOBALS['passenger_names'], $passenger_staff[$x]->name);
			 	$html.='<tr id="travel{{key}}">
					<td>'.$passenger_staff[$x]->name.'</td>
					<td>'.$passenger_staff[$x]->designation.'</td>
					<td>'.$passenger_staff[$x]->office.'</td>

				</tr>';

				$total_passenger++;
        		
        	}


        	for($x=0;$x<count($passenger_scholar);$x++) {

			 	$html.='<tr id="travel{{key}}">
					<td>'.$passenger_scholar[$x]->full_name.'</td>
					<td>Scholar</td>
					<td>'.$passenger_scholar[$x]->nationality.'</td>

				</tr>';

				$total_passenger++;
        		
        	}


        	for($x=0;$x<count($passenger_custom);$x++) {

			 	$html.='<tr id="travel{{key}}">
					<td>'.$passenger_custom[$x]->full_name.'</td>
					<td>'.$passenger_custom[$x]->designation.'</td>
					<td></td>

				</tr>';

				$total_passenger++;
        		
        	}
					
					
			while ($total_passenger<5) {
				$total_passenger++;
				$html.='<tr ng-repeat="(key, value) in [0,1,2,3,4,5]" id="travel{{key}}">
					<td><input type="date" class="dateSelector"></td>
					<td><input type="text" class="form-control text"></td>
					<td><input type="text" class="form-control text"></td>

				</tr>';
			}	
			

			
		
			

		$html.='</table>
		
	</article>';

$html.='<br/><br/><br/><article>
		<table>
			<tr>
				<td width="100"><b>&nbsp;&nbsp;Mode of Payment:</b></td>
				<td width="100" class="withLine">'.$itenerary->mode_of_payment.'</td>
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
     	#get data
    	$personal_travel=new Personal();
     	$itenerary=@json_decode($personal_travel->show($id))[0];
     	$personal_itenerary=new Personal_itenerary();

     	$charge_computation_module=new Charge();

    	$charges=@json_decode($personal_itenerary->show_charges($id))[0];

    	/*
    	$gasoline_charge=$charge_computation_module->calculate_gasoline_charge($charges->base,$charges->end-$charges->start,$charges->gasoline_charge,$default_rate='25');
    	

    	if($charges->appointment=='emergency'){
    		$drivers_charge=($charge_computation_module->calculate_emergency_drivers_charge($itenerary->departure_date,$itenerary->departure_time,$itenerary->returned_date,$itenerary->returned_time,$charges->drivers_charge));
    	}else{
			$drivers_charge=($charge_computation_module->calculate_contracted_drivers_charge($itenerary->departure_date,$itenerary->departure_time,$itenerary->returned_date,$itenerary->returned_time,$charges->drivers_charge,$charges->days));
    	}

    	$overall_gasoline_charge=@array_sum($gasoline_charge);
    	$overall_charge=$overall_gasoline_charge+$drivers_charge;


    	#prevent wrong calculation if returned date is < departure_date
        if($itenerary->departure_date<$itenerary->returned_date){
            $calculated_excess_time=$charge_computation_module->calculate_excess_time($itenerary->departure_date,$itenerary->departure_time,$itenerary->returned_date,$itenerary->returned_time);
        }*/

    	

    	#var_dump($calculated_excess_time);

        $overtime_original=@$charges->overtime/24;
        $overtime=explode('.', $overtime_original);
        $overtime_days=$overtime[0];
        $overtime_hours='0.'.@$overtime[1];
    	$overtime_hours=@($overtime_hours*24);

     	#var_dump($itenerary);

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
	self::is_creator($itenerary->requested_by);



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
				<td width="150" class="withLine">'.$itenerary->profile_name.'</td>
				<td width="10"></td>
				<td width="80"><b></b></td>
				<td width="150" ><b>No. '.$itenerary->id.'</b></td>
			</tr>
			<tr>
				<td width="150"><b>Office/Unit/Program/Project :</b></td>
				<td width="150" class="withLine">'.$itenerary->department_alias.'</td>
				<td width="10"></td>
				<td width="10"><b></b></td>
				<td width="150" class="withLine" align="center"><b>'.date_format(date_create($itenerary->date_created),'m/d/Y') .'</b></td>
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
				<p>'.@$itenerary->location.' - '.@$itenerary->destination.'</p>
				<br/><br/>
					<b>Note:</b> Php '.@$charges->gasoline_charge.', base'.@$charges->base.' km <br/>
				';
				
				if(strlen(@$charges->notes)>1){
				 
				 	$html.='<br/>Advance Charging : <b>'.@ucfirst($charges->notes).'</b>';
				 }

				$html.='	
				</td>


				<td><br/><br/>
					<b>Php '.@$charges->charge.'</b><br/><br/>
					<b>Charge :</b> Php '.@$charges->charge.'<br/>
					<b>Additional Charge:</b> Php '.@$charges->additional_charge.'<br/>
					<b>Over time :</b> '.@$overtime_days.' day(s) and '.@$overtime_hours.' hour(s)<br/>
					<b>Driver\'s Overtime Charge:</b> Php '.@round($charges->drivers_overtime_charge,2).'<br/>
				</td>
				
			</tr>';
			$html.='<tr>
				<td><input type="date" class="dateSelector"><b>Received by: </b></td>
				<td><input type="text" class="form-control text"><b>TOTAL : Php '.@round($charges->total,2).'</b></td>
				
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
