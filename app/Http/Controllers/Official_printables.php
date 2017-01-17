<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use PDF;
class Official_printables extends Controller
{
    function print_trip_ticket($id){
    	
		//get default settings from config/laravel-tcpdf.php
   		$pdf_settings = \Config::get('laravel-tcpdf');

   		$pdf = new \Elibyy\TCPDF\TCPdf($pdf_settings['page_orientation'], $pdf_settings['page_units'], $pdf_settings['page_format'], true, 'UTF-8', false);


   		// Custom Header
		$pdf->setHeaderCallback(function($pdf) {

		        // Set font
		        $pdf->SetFont('helvetica', 'B', 20);
		        // Title
		        $pdf->Cell(0, 15, 'Something new right here!!!', 0, false, 'C', 0, '', 0, false, 'M', 'M');

		});

		// Custom Footer
		$pdf->setFooterCallback(function($pdf) {

	        // Position at 15 mm from bottom
	        $pdf->SetY(-15);
	        // Set font
	        $pdf->SetFont('helvetica', 'I', 8);
	        // Page number
	        $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

  	  	});


   		$pdf->SetPrintHeader(false);
       // $pdf->SetPrintFooter(false);
        $pdf->AddPage();

        $pdf->output('Travel Request', 'I');
    }



    function print_travel_request($id){


    	//get default settings from config/laravel-tcpdf.php
   		$pdf_settings = \Config::get('laravel-tcpdf');

   		$pdf = new \Elibyy\TCPDF\TCPdf($pdf_settings['page_orientation'], $pdf_settings['page_units'], array(210,297), true, 'UTF-8', false);
   		


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
						<td width="150"><div class="withLine"></div></td><td></td>
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
						<td width="150"><div class="withLine"></div></td>
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
				<td width="220"></td><td></td><td class="withLine" style="text-align:center;"  width="100"><b></b></td>
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


$html.='<tr class="tr-passenger">
					<td class="withLine">name</td>
					<td class="withLine"></td>
					<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;<i>Scholar</i></td>
				</tr>';	

$html.='<tr class="tr-passenger">
					<td class="withLine">name</td>
					<td class="withLine"></td>
					<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;<i>Scholar</i></td>
				</tr>';	

$html.='<tr class="tr-passenger">
					<td class="withLine">name</td>
					<td class="withLine"></td>
					<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;<i>Scholar</i></td>
				</tr>';	

$html.='<tr class="tr-passenger">
					<td class="withLine">name</td>
					<td class="withLine"></td>
					<td class="withLine">&nbsp;&nbsp;&nbsp;&nbsp;<i>Scholar</i></td>
				</tr>';	
			
		
$html .= '</table>	</article>';

$html.='

	<article>
		<p><b>II. Purpose:</b></p>
		<p class="col col-md-12"><p></p></p>
	</article>
	<br/>
	<article>
		<p><b>III. Brief Itenerary:</b></p><br/>
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
		
	</article>';

$html.='<br/><br/><br/><article>
		<table>
			<tr>
				<td><b>IV. Cash Advance Requested </b></td><td style="text-align:right;">Source of Fund:</td><td class="withLine"></td>
			</tr>
		</table>

		<table>
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
