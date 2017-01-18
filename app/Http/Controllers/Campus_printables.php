<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use PDF;
class Campus_printables extends Controller
{
    

    function print_travel_request($id){


    	//get default settings from config/laravel-tcpdf.php
   		$pdf_settings = \Config::get('laravel-tcpdf');

   		$pdf = new \Elibyy\TCPDF\TCPdf($pdf_settings['page_orientation'], $pdf_settings['page_units'], array(210,297), true, 'UTF-8', false);
   		


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
					<p>*If the trip is by SEARCA service vehicle, recommendation for approval of requisitioner\'s immediate superior and corresponding approval of the HEad of the Facilities Management</p>
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
		<table class="table passenger-table" id="table-passenger">
			
				<tr>
					<th><b>Requesitioner :</b></th>
					<th width="220"></th>
					<th class="withLine" width="100"></th>
				</tr>
				<tr>
					<th><b>Office/Unit/Program/Project :</b></th>
					<th width="270"></th>
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
}
