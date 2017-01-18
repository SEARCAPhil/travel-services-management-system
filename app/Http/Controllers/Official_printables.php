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

   		$pdf = new \Elibyy\TCPDF\TCPdf($pdf_settings['page_orientation'], $pdf_settings['page_units'], array(210,297), true, 'UTF-8', false);
   		


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
				<td width="220"></td><td></td><td width="100"><b>NO. 290</b></td>
			</tr>

			
		</table>
		<br/>

		<table>
			<tr>
				<td width="220"></td><td></td><td class="withLine" style="text-align:center;"  width="100"><b></b></td>
			</tr>
			<tr>
				<td></td><td></td><td style="text-align:center;"><b>Date</b></td>
			</tr>

			
		</table>

	</article>';
	
$html.='	<article class="col col-md-12">
		<table class="table table-bordered sa-table "  style="font-size:0.8em;">
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
				<td> Requesting</td>
				<td> Source of fund:</td>

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
					
				
		$html .= '</table><br/><br/>';

			$html .= '	</td>
				<td> Purposes/Places to be visited: </td>

			</tr>


			<!--destination-->
			<tr>
				<td> Report to:<br/>
				&nbsp;Destination<br/>
				</td>
				<td>  </td>

			</tr>


			<!--Vehicle Plate-->
			<tr>
				<td> Vehicle/Plate no.:
			
				</td>
				<td> Assigned Driver:  </td>

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
						 	<td>Unit head,General Services</td>
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
						<td width="100"></td>
						<td></td>
					</tr>
					<tr>
						<td width="80">Time</td>
						<td width="100"></td>
						<td></td>
					</tr>
					<tr>
						<td width="80">Mileage Readind</td>
						<td width="100"></td>
						<td></td>
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
					<br/><br/><br/><br/>
					<table style="text-align:center;">
						 <tr>
						 	<td><b>RICARDO A. MENORCA</b></td>
						 </tr>
						 <tr>
						 	<td>Passenger\'s Signature</td>
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
				 &nbsp; No. of kms. :<br/>
				 &nbsp; Rate/km :<br/>
				 &nbsp;Amount :<br/>   
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
