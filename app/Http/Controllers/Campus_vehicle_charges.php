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
class Campus_vehicle_charges extends Controller
{
    


	function is_creator($id){
		if($_SESSION['priv']!='admin'){
			if($id!=@$_SESSION['profile_id']){

				echo '<br/><br/><center><h3>Sorry! File not found.</h3></center>';
				exit;
			}
		}
	}

  function print_vehicle_charges($id){
		global $travel_request;
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



    	 $overtime_original=@$charges->overtime/24;
        $overtime=explode('.', $overtime_original);
        $overtime_days=$overtime[0];
        $overtime_hours='0.'.@$overtime[1];
    	$overtime_hours=@($overtime_hours*24);


    	$fundings = @json_decode($official_travel->get_fundings($itenerary->tr_id));






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
			$pdf->image("img/logo-new.png",130,'',35);
			//$pdf->Cell(0, 0, '<img src="img/logo-new.png"/>', 0, 2, 'L', 0, '', 0, false, 'T', 'B');
			//$this->Cell(0, 0, 'Southeast Asian Ministers of Education Organization', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->Cell(0, 15, 'SOUTHEAST ASIAN REGIONAL CENTER FOR GRADUATE STUDY AND RESEARCH IN AGRICULTURE', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->Cell(0, 0, 'College, Laguna, 4031, Philippines', 0, 2, 'C', 0, '', 0, false, 'T', 'B');
			$pdf->setFontSize(15);
			$pdf->Cell(0, 10, 'Vehicle Charges', 0, 2, 'C', 0, '', 0, false, 'T', 'B');



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


$projects='';
for($a=0;$a<count($travel_request->projects);$a++){

	$projects.='<p>'.$travel_request->projects[$a]->project.'</p>';
}

$fund='';

switch ($travel_request->source_of_fund) {
	case 'opf':
		$fund='Operating Funds';
		break;
	case 'otf':
		$fund='Other Funds';
		break;
	case 'otfs':
		$fund='Other Funds (Scholars)';
		break;
	case 'sf':
		$fund='Special Funds';
		break;

	default:
		# code...
		break;
}

$html ='<style>

			.sa-table{margin-bottom:20px; border:1px solid rgb(80,80,80);}
			.sa-table td{margin-bottom:20px; border:1px solid rgb(80,80,80);}
			.withLine{border-bottom:1px solid rgb(20,20,20);overflow:hidden;text-align:left;padding-bottom:10px;margin-right:50px;}
		</style>


	<article>

		<table>
			<tr>
				<td width="400"></td><td></td><td width="100" style="text-align:right;font-weight:bold;font-size:12px;font-style:italic;color:gray;"><b>&nbsp;NO. '.$id.'&nbsp;</b>&nbsp;</td>
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

	<article>

		<br/>

		<table>
			<tr>
				<td width="400"></td><td></td><td class="withLine" style="text-align:center;"  width="100"><b>'.date('F d, Y') .'</b></td>
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
				<td width="50"><b>Purpose:</b></td>
				<td width="250" class="withLine">'.(@strlen($travel_request->purpose) > 100 ? substr($travel_request->purpose, 0, 80) : $travel_request->purpose).'</td>
				<td width="140"></td>
				<td width="40"><b>Month:</b></td>
				<td width="250" class="withLine">'.date_format(date_create($itenerary->date_created),'F') .' '.date_format(date_create($itenerary->date_created),'Y') .'</td>
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

			
				
			$itenerary_departure_date_formatted = @(new \DateTime($itenerary->departure_date))->format('F d, Y');
			$html.='<tr>
				<td><br/><br/>&nbsp;&nbsp;&nbsp;'.$itenerary_departure_date_formatted .'</td>
				<td height="60">
				<br/><br/>
					<b>&nbsp;&nbsp;'.$itenerary->location.' - '.$itenerary->destination.'</b><br/><br/>';

					$f='';
			
			for($x=0;$x<count($fundings);$x++){
				$f.='<span style="font-size:8px;">&nbsp;&nbsp;'.(isset($source_of_funds[$fundings[$x]->fund]) ? $source_of_funds[$fundings[$x]->fund] : $fundings[$x]->fund ).' - '.$fundings[$x]->cost_center.' - '.$fundings[$x]->line_item.'</span><br/>';
			}	

			$html.=$f;

			if($travel_request->source_of_fund=='otf'){
				$html.='<br/><br/><b>'.@$travel_request->projects[0]->project.'</b><br/>';
			}



					if(strlen(@$charges->notes)>1){
					 
					 	$html.='<p>Advance Charging : <b>'.@ucfirst($charges->notes).'</b><br/></p>';
					 }


					$html.='
				</td>


				<td><br/><br/>&nbsp;&nbsp;
					Php '.@number_format($charges->total, 2, '.', ',').'<br/><br/>
					
				</td>
				
			</tr>';

			$html.='<tr>
				<td colspan="2" style="text-align:right;">
					TOTAL
				</td>


				<td>
					<b>Php '.@number_format($charges->total, 2, '.', ',').'</b>
					
				</td>
				
			</tr>';


			$html.='<tr>
				<td><br/><br/>
					
					<b>Prepared By:</b>
					<br/><br/>
					<b  style="text-align:center;">VAN-ALLEN S. LIMBACO</b><br/>
					<span style="text-align:center;font-size:9px;">Transport Service Assistant</span><br/><br/>

				</td>
				<td>
					<br/><br/>
					<b>Certified By:</b><br/><br/>
					<b style="text-align:center;">RICARDO A. MENORCA</b><br/>
					<span style="text-align:center;font-size:9px;">Unit Head, General Services</span>
					<br/><br/>

				</td>

				<td>
					<br/><br/>
					<b>Conforme:</b><br/><br/>
					<b style="text-align:center;">'.$travel_request->approved_by.'</b><br/>
					<span style="text-align:center;font-size:9px;">'.$travel_request->approved_by_position.'</span><br/>

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




