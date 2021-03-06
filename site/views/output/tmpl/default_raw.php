<?php

jimport('mpdf.mpdf.mpdf');
jimport('mpdf.mpdf.vendor.autoload');
//jimport('fpdi/src/autoload.php');
$filename = 'Nomination_Paper.pdf';

// chars to keep in mind (in the template): á|é|í|ó|ú|ñ|ü|¡|«|»|¿

//Create an instance of the class:
$mpdf = new mPDF();

$mpdf->SetTitle('Nomination Paper');

	// Add styles
	$mpdf->addPageByArray(
		array(
				'sheet-size'=>'Legal',
				'margin-left'=>0,
				'margin-right'=>0,
				'margin-top'=>0,
				'margin-bottom'=>0,
			)
	);
	$mpdf->WriteHTML($this->css, 1);
$x=14;
$x_offset=181.5;
// only show additional pages based on presence of filenames
if ( $this->data->p_template_form || $this->data->p_template_affidavit || $this->data->p_template_instructions || $this->data->p_template_statement ) {
	$mpdf->SetImportUse();
}
if ( $this->data->p_template_form ) {
	$mpdf->SetSourceFile(JPATH_COMPONENT.'/assets/pdf/'.$this->data->p_template_form);
	$tplId = $mpdf->ImportPage(1);
	$mpdf->UseTemplate($tplId);

	// Write some HTML code:
	$mpdf->WriteHTML($this->html, 2);

	$mpdf->addPage();
	$tplId = $mpdf->ImportPage(2);
	$mpdf->UseTemplate($tplId);
}
if ( $this->data->p_template_affidavit ) {
	$mpdf->SetSourceFile(JPATH_COMPONENT.'/assets/pdf/'.$this->data->p_template_affidavit);
	$tplId = $mpdf->ImportPage(1);
	$mpdf->UseTemplate($tplId);
	// add a page back
	$mpdf->addPage();
	$mpdf->SetSourceFile(JPATH_COMPONENT.'/assets/pdf/blank_page.pdf');
	$tplId = $mpdf->ImportPage(1);
	$mpdf->UseTemplate($tplId);
}

if ( $this->data->p_template_instructions ) {
	$mpdf->addPage();
	$mpdf->SetSourceFile(JPATH_COMPONENT.'/assets/pdf/'.$this->data->p_template_instructions);
	$tplId = $mpdf->ImportPage(1);
	$mpdf->UseTemplate($tplId);
	$mpdf->addPage();
	$tplId = $mpdf->ImportPage(2);
	$mpdf->UseTemplate($tplId);
	$mpdf->addPage();
	$tplId = $mpdf->ImportPage(3);
	$mpdf->UseTemplate($tplId);
	$mpdf->addPage();
	$tplId = $mpdf->ImportPage(4);
	$mpdf->UseTemplate($tplId);
}
if ( $this->data->p_template_statement ) {
	$mpdf->addPage();
	$mpdf->SetSourceFile(JPATH_COMPONENT.'/assets/pdf/'.$this->data->p_template_statement);
	$tplId = $mpdf->ImportPage(1);
	$mpdf->UseTemplate($tplId);
	$mpdf->addPage();
	$tplId = $mpdf->ImportPage(2);
	$mpdf->UseTemplate($tplId);
	$mpdf->addPage();
	$tplId = $mpdf->ImportPage(3);
	$mpdf->UseTemplate($tplId);
	$mpdf->addPage();
	$tplId = $mpdf->ImportPage(4);
	$mpdf->UseTemplate($tplId);
}
// Output a PDF file directly to the browser
$mpdf->Output($filename, JRequest::getVar('download') == 'true' ? 'D' : 'I');

exit();
