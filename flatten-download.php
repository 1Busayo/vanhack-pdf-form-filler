<?php
	// Connect to the database
	require_once("_dbConfig.php");
	
	// Put the unique user id in a variable - the script know what record to pull from the database because of this variable, which comes to the script as a GET variable in this case. You could/should use a fancier, securer, less user-editable way of transmitting ids, like using a unique md5 hash for the id... again, this is just a simple example
	$id = $_GET['id'];
	
	// Retrieve data from database
	$sql = "SELECT * FROM users WHERE id = '$id' LIMIT 1";
	$result = mysqli_query($connection,$sql);
	
	if (!$result) {
		die('Could not query: ' . mysqli_error());
	}
	
	if (mysqli_num_rows($result) == 1) {
		// Include pdftk-php class
		require('pdftk-php-flatten.php');
		
		// Initiate the class
		$pdfmaker = new pdftk_php;
		
		// Define variables for all the data fields in the PDF form. You need to assign a column in the database to each field that you'll be using in the PDF. 
		// Example:
		// $pdf_column = $data['column'];
		
		// You can also format the MySQL data how you want here. One common example is formatting a date saved in the database. For example:
		// $pdf_date = date("l, F j, Y, g:i a", strtotime($data['date']));
		
		$data = mysqli_fetch_array($result);
		//Designated Referral Partner Organization Name
		$page1_field1 = "Acme Inc";
		//First Name
		$page1_field2 =$data['firstname'];
		//Midde Name
		$page1_field3 = $data['middlename'];
		//Last Name
		$page1_field4 = $data['lastname'];
		//Telephone Number and Extension
		$page1_field5 = "+2348129974874";
		//Alternate Telephone Number and Extension
		$page1_field6 = "+2349076173410";
		//Fax Number
		$page1_field7 = "+2349076173410";
		//E-mail Address
		$page1_field8 = "fanimokunbusayo@gmail.com";
		//first name2
		$page1_field9 = $data['firstname'];
		//middle name2
		$page1_field10 = 'Nelson';
         //LastName2
		$page1_field11 = $data['lastname'];
         //Telephone number and Extension2
		$page1_field12 = "+2349076173410";
         //Alternate Telephone number and Extension2
		$page1_field13 = "+2349076173410";
        //Fax Number
		$page1_field14 = "+2349076173410";
		//E-mail Address 2
		$page1_field15 = "fanimokunbusayo@gmail.com";
		//Business Legal Name
		$page2_field1 = "Acme Group";
		//Business Address - Line 1
		$page2_field2 = "21 Leon drive";
		//Business Address - Line 2
		$page2_field3 = "Vancouver ,Canada";
		//Province/Territory/State
		$page2_field4 = "Vancouver";
		//province
		$page2_field5 = "British Columbia";
		//Country
		$page2_field6 = "Canada";
		//Postal/Zip Code:
		$page2_field7 = "V5K";
		//Mailing Address if different from business address; Line 1 :
        $page2_field8 = "21 Leon drive";
		//Mailing Address if different from business address; Line 2 :
        $page2_field9 = "Vancouver ,Canada";
		//Mailing Address if different from business address; City
      $page2_field10 = "Vancouver ,Canada";
		// Mailing Address if different from business address; Province/Territory/State
          $page2_field11 = "British Columbia";
		//  Mailing Address if different from business address; Country
           $page2_field12 = "Canada";
		//  Mailing Address if different from business address; Postal/Zip Code
           $page2_field13 = "V5K";
		//  Website Address
           $page2_field14 = "http://vanhack.com";
		// Date business started ( Year - Month - Day )
           $page2_field15 = "1998-08-12";
		// How many employees are employed nationally under the employer's Canada Revenue Agency business number?
          $page2_field16 = "50,000";
		//  What is the annual gross revenue of the business (in $CAD)
          $page2_field17 = "1,000,000";
		//  Does your business receive support through Employment and Social Development Canada's Work-Sharing Program? If yes, provide details:
		$page2_field18 = "Yes";
		//job title
		$page2_field19 = "Software Engr";
		//FirstName
		$page2_field20 = "James";
		//Middle Name
		$page2_field21 = "clinton";
		//LastName
		$page2_field22 = "Boolmberg";
		//Telephone Number and Extension
		$page2_field23 = "+234800000000";
		//Alternate Telephone Number and Extension
		$page2_field24 = "+234800000000";
		//Fax Number
		$page2_field25 = "+234800000000";
		//Email Address
		$page2_field26 = "fanimokunbusayo@gmail.com";
		//Job title
		$page2_field27 = "Software Engr";
		//FirstName
		$page2_field28 = "Bola";
		//MiddleName
		$page2_field29 = "Shola";
		//LastName
		$page2_field30 = "Tesla";
		//Telephone Number and Extension
		$page2_field31 = "+234800000000";
		//Alternate Telephone Number and Extension
		$page2_field32 = "+234800000000";
		//Fax Number
		$page2_field33 = "+234800000000";
		//Email Address
		$page2_field34 = "fanimokunbusayo@gmail.com";
		//Activity Operation
		$page2_field35 = "123456789";
		//Activity Operation
		$page2_field36 = "BW0001";
		
		//page6 section9,10
		$pg6_sec9_1 = "Twf can be identified has the position";
		$pg6_sec9_table1_col1 = "Activity with Milestone";
		$pg6_sec9_table1_col2 = "Target";
		$pg6_sec9_table1_col3 = "11/17/2019";
		$pg6_sec9_table1_col4 = "11/17/2025";
		//page9 section11
		$pg9_sec11_2 = "Mr Francis Cotlinks";
		$pg9_sec11_3 = "CEO";
		$pg9_sec11_4 = "2019-07-12";
		
		//page11 to 13 (workers)
		$wrk1_fld1 ="Thomas";
		$wrk1_fld2 ="Edison";
		$wrk1_fld3 ="1990-05-12";
		$wrk1_fld4 ="Nigerian";
		$wrk1_fld5 ="Lagos";
		$wrk1_fld6 ="Nigeria";
		$wrk1_fld7 ="Vancouver";
		$wrk1_fld8 ="Canada";
		
		// $fdf_data_strings associates the names of the PDF form fields to the PHP variables you just set above. In order to work correctly the PDF form field name has to be exact. PDFs made in Acrobat generally have simpler names - just the name you assigned to the field. PDFs made in LiveCycle Designer nest their forms in other random page elements, creating a long and hairy field name. You can use pdftk to discover the real names of your PDF form fields: run "pdftk form.pdf dump_data_fields > form-fields.txt" to generate a report.

		// Example of field names from a PDF created in LiveCycle:
		// $fdf_data_strings= array('form1[0].#subform[0].#area[0].LastName[0]' => $pdf_lastname,  'form1[0].#subform[0].#area[0].FirstName[0]' => $pdf_firstname, 'form1[0].#subform[0].#area[0].EMail[0]' => $pdf_email, );
		$fdf_data_strings= array(
		'EMP5624_E[0].Page1[0].txtF_des_part[0]' => $page1_field1,
		'EMP5624_E[0].Page1[0].txtF_first_name[0]'=> $page1_field2,
		'EMP5624_E[0].Page1[0].txtF_mid_name[0]'=> $page1_field3,
		'EMP5624_E[0].Page1[0].txtF_last_name[0]' => $page1_field4,
		'EMP5624_E[0].Page1[0].txtF_phone_number[0]' => $page1_field5,
		'EMP5624_E[0].Page1[0].txtF_alternate_phone[0]' => $page1_field6,
		'EMP5624_E[0].Page1[0].txtF_fax_number[0]' => $page1_field7,
		 'EMP5624_E[0].Page1[0].txtF_Email[0]' => $page1_field8,
		'EMP5624_E[0].Page1[0].txtF_first_name2[0]' => $page1_field9,
		'EMP5624_E[0].Page1[0].txtF_mid_name2[0]' => $page1_field10,
		'EMP5624_E[0].Page1[0].txtF_last_name2[0]' => $page1_field11,
		'EMP5624_E[0].Page1[0].txtF_phone_number2[0]' => $page1_field12,
		'EMP5624_E[0].Page1[0].txtF_alternate_phone2[0]' => $page1_field13,
		'EMP5624_E[0].Page1[0].txtF_fax_number2[0]' => $page1_field14,
		'EMP5624_E[0].Page1[0].txtF_Email2[0]'=> $page1_field15,
		//page2
		'EMP5624_E[0].Page2[0].txtF_Emp_Legal[0]'=>$page2_field1,
		'EMP5624_E[0].Page2[0].txtF_Mail_Adress1[0]'=>$page2_field2,
		'EMP5624_E[0].Page2[0].txtF_Mail_Adress2[0]'=>$page2_field3,
		'EMP5624_E[0].Page2[0].txtF_City[0]'=>$page2_field4,
		'EMP5624_E[0].Page2[0].txtF_Province[0]'=>$page2_field5,
		'EMP5624_E[0].Page2[0].txtF_Country[0]'=>$page2_field6,
		'EMP5624_E[0].Page2[0].txtF_Postal_Code[0]'=>$page2_field7,
		'EMP5624_E[0].Page2[0].txtF_Mail_Adress2-1[0]'=>$page2_field8,
		'EMP5624_E[0].Page2[0].txtF_Mail_Adress2-2[0]'=>$page2_field9,
	    'EMP5624_E[0].Page2[0].txtF_City2[0]'=>$page2_field10,
		'EMP5624_E[0].Page2[0].txtF_Province2[0]'=>$page2_field11,
		'EMP5624_E[0].Page2[0].txtF_Country2[0]' => $page2_field12,
		'EMP5624_E[0].Page2[0].txtF_Postal_Code2[0]' => $page2_field13,
		'EMP5624_E[0].Page2[0].txtF_Employer_Web_Address[0]' => $page2_field14,
		'EMP5624_E[0].Page2[0].txtF_Employer_Date_Business[0]' => $page2_field15,
		'EMP5624_E[0].Page2[0].txtF_amout_employees[0]' => $page2_field16,
		'EMP5624_E[0].Page2[0].txtF_business_revenu[0]' => $page2_field17,
		'EMP5624_E[0].Page2[0].txtF_If_Yes2[0]' => $page2_field18,
		'EMP5624_E[0].Page2[0].txtF_position_title[0]' => $page2_field19,
	    'EMP5624_E[0].Page2[0].txtF_first_name2[0]' => $page2_field20,
		'EMP5624_E[0].Page2[0].txtF_mid_name2[0]' => $page2_field21,
	    'EMP5624_E[0].Page2[0].txtF_last_name2[0]' => $page2_field22,
		'EMP5624_E[0].Page2[0].txtF_phone_number2[0]' => $page2_field23,
		'EMP5624_E[0].Page2[0].txtF_alternate_phone2[0]' => $page2_field24,
		'EMP5624_E[0].Page2[0].txtF_fax_number2[0]' => $page2_field25,
		'EMP5624_E[0].Page2[0].txtF_Email2[0]' => $page2_field26,
		'EMP5624_E[0].Page2[0].txtF_other_position_title[0]' => $page2_field27,
		'EMP5624_E[0].Page2[0].txtF_other_first_name2[0]' => $page2_field28,
		'EMP5624_E[0].Page2[0].txtF_other_mid_name2[0]' => $page2_field29,
		'EMP5624_E[0].Page2[0].txtF_other_last_name2[0]' => $page2_field30,
		'EMP5624_E[0].Page2[0].txtF_other_phone_number2[0]' => $page2_field31,
		'EMP5624_E[0].Page2[0].txtF_other_alternate_phone2[0]' => $page2_field32,
		'EMP5624_E[0].Page2[0].txtF_other_fax_number2[0]' => $page2_field33,
		'EMP5624_E[0].Page2[0].txtF_other_Email2[0]' => $page2_field34,
		'EMP5624_E[0].Page2[0].num_Company_Code[0]' => $page2_field35,
		'EMP5624_E[0].Page2[0].num_Company_Code[1]' => $page2_field36,
		//page 3
		
		//page 6 section9
		'EMP5624_E[0].Page6[0].txtF_advantage[0]' => $pg6_sec9_1,
		'EMP5624_E[0].Page6[0].Table1[0].Row1[0].TextField1[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page6[0].Table1[0].Row1[0].TextField2[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page6[0].Table1[0].Row1[0].DateField1[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page6[0].Table1[0].Row1[0].DateField2[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page6[0].Table1[0].Row2[0].TextField3[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page6[0].Table1[0].Row2[0].TextField4[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page6[0].Table1[0].Row2[0].DateField3[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page6[0].Table1[0].Row2[0].DateField4[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page6[0].Table1[0].Row3[0].TextField5[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page6[0].Table1[0].Row3[0].TextField6[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page6[0].Table1[0].Row3[0].DateField5[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page6[0].Table1[0].Row3[0].DateField6[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page6[0].Table1[0].Row4[0].TextField7[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page6[0].Table1[0].Row4[0].TextField8[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page6[0].Table1[0].Row4[0].DateField7[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page6[0].Table1[0].Row4[0].DateField8[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page6[0].Table1[0].Row5[0].TextField9[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page6[0].Table1[0].Row5[0].TextField10[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page6[0].Table1[0].Row5[0].DateField9[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page6[0].Table1[0].Row5[0].DateField10[0]' => $pg6_sec9_table1_col4,
	  
	   'EMP5624_E[0].Page6[0].Table1[0].Row6[0].TextField11[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page6[0].Table1[0].Row6[0].TextField12[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page6[0].Table1[0].Row6[0].DateField11[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page6[0].Table1[0].Row6[0].DateField12[0]' => $pg6_sec9_table1_col4,
		
		//page7 section10
		'EMP5624_E[0].Page7[0].txtF_advantage1[0]' => $pg6_sec9_1,
		'EMP5624_E[0].Page7[0].Table1[0].Row1[0].TextField1[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table1[0].Row1[0].TextField2[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table1[0].Row1[0].DateField1[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table1[0].Row1[0].DateField2[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page7[0].Table1[0].Row2[0].TextField3[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table1[0].Row2[0].TextField4[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table1[0].Row2[0].DateField3[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table1[0].Row2[0].DateField4[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page7[0].Table1[0].Row3[0].TextField5[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table1[0].Row3[0].TextField6[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table1[0].Row3[0].DateField5[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table1[0].Row3[0].DateField6[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page7[0].Table1[0].Row4[0].TextField7[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table1[0].Row4[0].TextField8[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table1[0].Row4[0].DateField7[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table1[0].Row4[0].DateField8[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page7[0].Table1[0].Row5[0].TextField9[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table1[0].Row5[0].TextField10[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table1[0].Row5[0].DateField9[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table1[0].Row5[0].DateField10[0]' => $pg6_sec9_table1_col4,
	  
	   'EMP5624_E[0].Page7[0].Table1[0].Row6[0].TextField11[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table1[0].Row6[0].TextField12[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table1[0].Row6[0].DateField11[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table1[0].Row6[0].DateField12[0]' => $pg6_sec9_table1_col4,
 	   //table2
	   'EMP5624_E[0].Page7[0].txtF_advantage1[1]' => $pg6_sec9_1,
		'EMP5624_E[0].Page7[0].Table2[0].Row1[0].TextField1[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table2[0].Row1[0].TextField2[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table2[0].Row1[0].DateField1[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table2[0].Row1[0].DateField2[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page7[0].Table2[0].Row2[0].TextField3[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table2[0].Row2[0].TextField4[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table2[0].Row2[0].DateField3[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table2[0].Row2[0].DateField4[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page7[0].Table2[0].Row3[0].TextField5[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table2[0].Row3[0].TextField6[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table2[0].Row3[0].DateField5[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table2[0].Row3[0].DateField6[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page7[0].Table2[0].Row4[0].TextField7[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table2[0].Row4[0].TextField8[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table2[0].Row4[0].DateField7[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table2[0].Row4[0].DateField8[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page7[0].Table2[0].Row5[0].TextField9[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table2[0].Row5[0].TextField10[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table2[0].Row5[0].DateField9[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table2[0].Row5[0].DateField10[0]' => $pg6_sec9_table1_col4,
	  
	   'EMP5624_E[0].Page7[0].Table2[0].Row6[0].TextField11[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table2[0].Row6[0].TextField12[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table2[0].Row6[0].DateField11[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table2[0].Row6[0].DateField12[0]' => $pg6_sec9_table1_col4,
		 //table3
	   'EMP5624_E[0].Page7[0].txtF_advantage1[2]' => $pg6_sec9_1,
		'EMP5624_E[0].Page7[0].Table3[0].Row1[0].TextField1[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table3[0].Row1[0].TextField2[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table3[0].Row1[0].DateField1[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table3[0].Row1[0].DateField2[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page7[0].Table3[0].Row2[0].TextField3[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table3[0].Row2[0].TextField4[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table3[0].Row2[0].DateField3[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table3[0].Row2[0].DateField4[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page7[0].Table3[0].Row3[0].TextField5[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table3[0].Row3[0].TextField6[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table3[0].Row3[0].DateField5[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table3[0].Row3[0].DateField6[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page7[0].Table3[0].Row4[0].TextField7[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table3[0].Row4[0].TextField8[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table3[0].Row4[0].DateField7[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table3[0].Row4[0].DateField8[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page7[0].Table3[0].Row5[0].TextField9[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table3[0].Row5[0].TextField10[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table3[0].Row5[0].DateField9[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table3[0].Row5[0].DateField10[0]' => $pg6_sec9_table1_col4,
	  
	   'EMP5624_E[0].Page7[0].Table3[0].Row6[0].TextField11[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page7[0].Table3[0].Row6[0].TextField12[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page7[0].Table3[0].Row6[0].DateField11[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page7[0].Table3[0].Row6[0].DateField12[0]' => $pg6_sec9_table1_col4,
		//table 4
		'EMP5624_E[0].Page8[0].txtF_advantage1[0]' => $pg6_sec9_1,
		'EMP5624_E[0].Page8[0].Table1[0].Row1[0].TextField1[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table1[0].Row1[0].TextField2[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table1[0].Row1[0].DateField1[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table1[0].Row1[0].DateField2[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page8[0].Table1[0].Row2[0].TextField3[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table1[0].Row2[0].TextField4[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table1[0].Row2[0].DateField3[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table1[0].Row2[0].DateField4[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page8[0].Table1[0].Row3[0].TextField5[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table1[0].Row3[0].TextField6[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table1[0].Row3[0].DateField5[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table1[0].Row3[0].DateField6[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page8[0].Table1[0].Row4[0].TextField7[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table1[0].Row4[0].TextField8[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table1[0].Row4[0].DateField7[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table1[0].Row4[0].DateField8[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page8[0].Table1[0].Row5[0].TextField9[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table1[0].Row5[0].TextField10[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table1[0].Row5[0].DateField9[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table1[0].Row5[0].DateField10[0]' => $pg6_sec9_table1_col4,
	  
	   'EMP5624_E[0].Page8[0].Table1[0].Row6[0].TextField11[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table1[0].Row6[0].TextField12[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table1[0].Row6[0].DateField11[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table1[0].Row6[0].DateField12[0]' => $pg6_sec9_table1_col4,
 	   
		//table5
	   'EMP5624_E[0].Page8[0].txtF_advantage1[1]' => $pg6_sec9_1,
		'EMP5624_E[0].Page8[0].Table2[0].Row1[0].TextField1[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table2[0].Row1[0].TextField2[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table2[0].Row1[0].DateField1[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table2[0].Row1[0].DateField2[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page8[0].Table2[0].Row2[0].TextField3[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table2[0].Row2[0].TextField4[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table2[0].Row2[0].DateField3[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table2[0].Row2[0].DateField4[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page8[0].Table2[0].Row3[0].TextField5[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table2[0].Row3[0].TextField6[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table2[0].Row3[0].DateField5[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table2[0].Row3[0].DateField6[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page8[0].Table2[0].Row4[0].TextField7[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table2[0].Row4[0].TextField8[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table2[0].Row4[0].DateField7[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table2[0].Row4[0].DateField8[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page8[0].Table2[0].Row5[0].TextField9[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table2[0].Row5[0].TextField10[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table2[0].Row5[0].DateField9[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table2[0].Row5[0].DateField10[0]' => $pg6_sec9_table1_col4,
	  
	   'EMP5624_E[0].Page8[0].Table2[0].Row6[0].TextField11[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table2[0].Row6[0].TextField12[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table2[0].Row6[0].DateField11[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table2[0].Row6[0].DateField12[0]' => $pg6_sec9_table1_col4,
		//table 6
		'EMP5624_E[0].Page8[0].txtF_advantage1[2]' => $pg6_sec9_1,
		'EMP5624_E[0].Page8[0].Table3[0].Row1[0].TextField1[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table3[0].Row1[0].TextField2[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table3[0].Row1[0].DateField1[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table3[0].Row1[0].DateField2[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page8[0].Table3[0].Row2[0].TextField3[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table3[0].Row2[0].TextField4[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table3[0].Row2[0].DateField3[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table3[0].Row2[0].DateField4[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page8[0].Table3[0].Row3[0].TextField5[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table3[0].Row3[0].TextField6[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table3[0].Row3[0].DateField5[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table3[0].Row3[0].DateField6[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page8[0].Table3[0].Row4[0].TextField7[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table3[0].Row4[0].TextField8[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table3[0].Row4[0].DateField7[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table3[0].Row4[0].DateField8[0]' => $pg6_sec9_table1_col4,
		
		'EMP5624_E[0].Page8[0].Table3[0].Row5[0].TextField9[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table3[0].Row5[0].TextField10[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table3[0].Row5[0].DateField9[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table3[0].Row5[0].DateField10[0]' => $pg6_sec9_table1_col4,
	  
	   'EMP5624_E[0].Page8[0].Table3[0].Row6[0].TextField11[0]' => $pg6_sec9_table1_col1,
		'EMP5624_E[0].Page8[0].Table3[0].Row6[0].TextField12[0]' => $pg6_sec9_table1_col2,
		'EMP5624_E[0].Page8[0].Table3[0].Row6[0].DateField11[0]' => $pg6_sec9_table1_col3,
		'EMP5624_E[0].Page8[0].Table3[0].Row6[0].DateField12[0]' => $pg6_sec9_table1_col4,
		
		//section11 page9
		'EMP5624_E[0].Page9[0].txtF_Employer_Print_Name[0]' =>$pg9_sec11_2,
		'EMP5624_E[0].Page9[0].txtF_Employer_Title[0]' =>$pg9_sec11_3,
		'EMP5624_E[0].Page9[0].txtF_Today_Date_1[0]' =>$pg9_sec11_4,
		'EMP5624_E[0].Page9[0].txtF_Employer_Print_Name[1]' =>$pg9_sec11_2,
		'EMP5624_E[0].Page9[0].txtF_Today_Date_1[1]' =>$pg9_sec11_4,
		'EMP5624_E[0].Page9[0].txtF_Employer_Print_Name[2]' =>$pg9_sec11_2,
		'EMP5624_E[0].Page9[0].txtF_Today_Date_1[2]' =>$pg9_sec11_4,
		'EMP5624_E[0].Page9[0].txtF_Employer_Print_Name[3]' =>$pg9_sec11_2,
		'EMP5624_E[0].Page9[0].txtF_Today_Date_1[3]' =>$pg9_sec11_4,
		//page11 to 13(workers)
		'EMP5624_E[0].Page12[0].txtF_Family_Name1[0]' => $wrk1_fld1,
		'EMP5624_E[0].Page12[0].txtF_First_Name1[0]' => $wrk1_fld2,
		'EMP5624_E[0].Page12[0].txtF_Date_of_Birth1[0]' => $wrk1_fld3,
		'EMP5624_E[0].Page12[0].txtF_Citizenship1[0]' => $wrk1_fld4,
		 'EMP5624_E[0].Page12[0].txtF_City1[0]' =>$wrk1_fld5,
		'EMP5624_E[0].Page12[0].txtF_Country1[0]' => $wrk1_fld6,
		 'EMP5624_E[0].Page12[0].txtF_City1b[0]' =>$wrk1_fld7,
		 'EMP5624_E[0].Page12[0].txtF_Country1b[0]' =>$wrk1_fld8,
		
		'EMP5624_E[0].Page12[0].txtF_Family_Name2[0]' => $wrk1_fld1,
		'EMP5624_E[0].Page12[0].txtF_First_Name2[0]' => $wrk1_fld2,
		'EMP5624_E[0].Page12[0].txtF_Date_of_Birth2[0]' => $wrk1_fld3,
		'EMP5624_E[0].Page12[0].txtF_Citizenship1[1]' => $wrk1_fld4,
		 'EMP5624_E[0].Page12[0].txtF_City2[0]' =>$wrk1_fld5,
		'EMP5624_E[0].Page12[0].txtF_Country2[0]' => $wrk1_fld6,
		 'EMP5624_E[0].Page12[0].txtF_City2b[0]' =>$wrk1_fld7,
		 'EMP5624_E[0].Page12[0].txtF_Country2b[0]' =>$wrk1_fld8,
		 
		 'EMP5624_E[0].Page12[0].txtF_Family_Name3[0]' => $wrk1_fld1,
		'EMP5624_E[0].Page12[0].txtF_First_Name2[1]' => $wrk1_fld2,
		'EMP5624_E[0].Page12[0].txtF_Date_of_Birth3[0]' => $wrk1_fld3,
		'EMP5624_E[0].Page12[0].txtF_Citizenship3[0]' => $wrk1_fld4,
		 'EMP5624_E[0].Page12[0].txtF_City3[0]' =>$wrk1_fld5,
		'EMP5624_E[0].Page12[0].txtF_Country3[0]' => $wrk1_fld6,
		 'EMP5624_E[0].Page12[0].txtF_City3b[0]' =>$wrk1_fld7,
		 'EMP5624_E[0].Page12[0].txtF_Country3b1[1]' =>$wrk1_fld8,
		 
	  'EMP5624_E[0].Page13[0].txtF_Family_Name4[0]' => $wrk1_fld1,
		'EMP5624_E[0].Page13[0].txtF_First_Name4[0]' => $wrk1_fld2,
		'EMP5624_E[0].Page13[0].txtF_Date_of_Birth4[0]' => $wrk1_fld3,
		'EMP5624_E[0].Page13[0].txtF_Citizenship4[0]' => $wrk1_fld4,
		 'EMP5624_E[0].Page13[0].txtF_City4[0]' =>$wrk1_fld5,
		'EMP5624_E[0].Page13[0].txtF_Country4[0]' => $wrk1_fld6,
		 'EMP5624_E[0].Page13[0].txtF_City4b[0]' =>$wrk1_fld7,
		 'EMP5624_E[0].Page13[0].txtF_Country4b[0]' =>$wrk1_fld8,
		
		'EMP5624_E[0].Page13[0].txtF_Family_Name5[0]' => $wrk1_fld1,
		'EMP5624_E[0].Page13[0].txtF_First_Name5[0]' => $wrk1_fld2,
		'EMP5624_E[0].Page13[0].txtF_Date_of_Birth5[0]' => $wrk1_fld3,
		'EMP5624_E[0].Page13[0].txtF_Citizenship5[0]' => $wrk1_fld4,
		 'EMP5624_E[0].Page13[0].txtF_City5[0]' =>$wrk1_fld5,
		'EMP5624_E[0].Page13[0].txtF_Country5[0]' => $wrk1_fld6,
		 'EMP5624_E[0].Page13[0].txtF_City5b[0]' =>$wrk1_fld7,
		 'EMP5624_E[0].Page13[0].txtF_Country5b[0]' =>$wrk1_fld8
		);
		
		// See the documentation of pdftk-php.php for more explanation of these other variables.
		
		// Used for radio buttons and check boxes
		// Example: (For check boxes options are Yes and Off)
		// $pdf_checkbox1 = "Yes";
		// $pdf_checkbox2 = "Off";
		// $pdf_checkbox3 = "Yes";
		// $fdf_data_names = array('checkbox1' => $pdf_checkbox1,'checkbox2' => $pdf_checkbox2,'checkbox3' => $pdf_checkbox3,'checkbox4' => $pdf_checkbox4); 

		//Does the occupation of the position(s) you are seeking to fill appear on the Global Talent Occupations List that has been published on the TFW Program website?; Yes - skip to Section 2
		$checkbox1 = "1";
		// published on the TFW Program website?; No - Proceed to next question
       $checkbox2="1";
	   //Are you an innovative employer referred to the Global Talent Stream by an ESDC Designated Referral Partner?; Yes
	   $checkbox3="1";
	   // Are you an innovative employer referred to the Global Talent Stream by an ESDC Designated Referral Partner?;  No - you are not eligible to apply for an LMIA using this Global Talent Stream LMIA application form. Please visit the TFW.&#13;Program website for further information on other program streams.
	   $checkbox4="1";
	   //1 or 2 is the value
	   $checkbox5="1";
	   //1 or 2 is the value
	   $checkbox6="1";
	   //1 or 2 is the value
	   $checkbox7="2";
	    //1 or 2 is the value
	   $checkbox8="2";
	   //Organization type and structure (select all that apply); Business: sole proprietorship
       $checkbox9="1";
	   $checkbox10="1";
	   $checkbox11="1";
	   $checkbox12="1";
	   $checkbox13="1";
	   $checkbox14="1";
	   //1 or 2
	   $checkbox15="2";
	   //1 or 2
	   $checkbox16="2";
	   //1 or 2
	   $checkbox17="2";
	   //1 or 2
	   $checkbox18="2";
	   //1 or 2
	   $checkbox19="2";
	   //1 or 2
	   $checkbox20="2";
	   //page 11 to 13 (workers)
        $checkbox_gender = '1';
		$checkbox_twf = '1';
		
	
		
		$fdf_data_names = array(
		'EMP5624_E[0].Page1[0].Yes_business[0]' => $checkbox1 ,
		'EMP5624_E[0].Page1[0].No_business[0]' => $checkbox2,
		'EMP5624_E[0].Page1[0].Yes_inn[0]' => $checkbox3,
		'EMP5624_E[0].Page1[0].No_inn[0]' => $checkbox4,
		'EMP5624_E[0].Page1[0].rb_language_oral[0]' => $checkbox5,
		'EMP5624_E[0].Page1[0].rb_language_written[0]' => $checkbox6,
		'EMP5624_E[0].Page1[0].rb_language_oral2[0]' => $checkbox7,
		'EMP5624_E[0].Page1[0].rb_language_written2[0]' => $checkbox8,
		'EMP5624_E[0].Page2[0].cb_individual[0]' => $checkbox9,
		'EMP5624_E[0].Page2[0].cb_partnership[0]' => $checkbox10,
		'EMP5624_E[0].Page2[0].cb_society[0]' => $checkbox11,
		'EMP5624_E[0].Page2[0].cb_sole_propietor[0]' => $checkbox11,
		'EMP5624_E[0].Page2[0].cb_not_profit[0]' => $checkbox12,
		'EMP5624_E[0].Page2[0].cb_registred[0]' => $checkbox13,
		'EMP5624_E[0].Page2[0].txtF_amout_employees[0]' => $checkbox14,
		'EMP5624_E[0].Page2[0].rb_receive_prog[0]' => $checkbox15,
		'EMP5624_E[0].Page2[0].rb_language_oral2[0]' => $checkbox16,
		'EMP5624_E[0].Page2[0].rb_language_written2[0]' => $checkbox17,
		'EMP5624_E[0].Page2[0].rb_other_language_oral2[0]' => $checkbox18,
		'EMP5624_E[0].Page2[0].rb_other_anguage_written2[0]' => $checkbox19,
		'EMP5624_E[0].Page2[0].rb_tiers[0]' => $checkbox20,
		//page 11 to 13 (workers)
		'EMP5624_E[0].Page12[0].rb_Gender1[0]' => $checkbox_gender,
		'EMP5624_E[0].Page12[0].Temporary_foreign_worker1[0]'=> $checkbox_twf,
		'EMP5624_E[0].Page12[0].visitor[0]'=> $checkbox_twf,
		'EMP5624_E[0].Page12[0].student[0]'=> $checkbox_twf,
		
		'EMP5624_E[0].Page12[0].rb_Gender2[0]' => $checkbox_gender,
		'EMP5624_E[0].Page12[0].Temporary_foreign_worker2[0]'=> $checkbox_twf,
		'EMP5624_E[0].Page12[0].visitor2[0]'=> $checkbox_twf,
		'EMP5624_E[0].Page12[0].student2[0]'=> $checkbox_twf,
		
		'EMP5624_E[0].Page12[0].rb_Gender3[0]' => $checkbox_gender,
		'EMP5624_E[0].Page12[0].Temporary_foreign_worker3[0]'=> $checkbox_twf,
		'EMP5624_E[0].Page12[0].visitor3[0]'=> $checkbox_twf,
		'EMP5624_E[0].Page12[0].student3[0]'=> $checkbox_twf,
		
		'EMP5624_E[0].Page13[0].rb_Gender4[0]' => $checkbox_gender,
		'EMP5624_E[0].Page13[0].Temporary_foreign_worker4[0]'=> $checkbox_twf,
		'EMP5624_E[0].Page13[0].visitor4[0]'=> $checkbox_twf,
		'EMP5624_E[0].Page13[0].student4[0]'=> $checkbox_twf,
		
		'EMP5624_E[0].Page13[0].rb_Gender5[0]' => $checkbox_gender,
		'EMP5624_E[0].Page13[0].Temporary_foreign_worker5[0]'=> $checkbox_twf,
		'EMP5624_E[0].Page13[0].visitor5[0]'=> $checkbox_twf,
		'EMP5624_E[0].Page13[0].student5[0]'=> $checkbox_twf,
		); // Leave empty if there are no radio buttons or check boxes
		
		$fields_hidden = array(); // Used to hide form fields
		
		$fields_readonly = array(); // Used to make fields read only - however, flattening the output with pdftk will in effect make every field read only. If you don't want a flattened pdf and still want some read only fields, use this variable and remove the flatten flag near line 70 in pdftk-php.php
		
		// Take each REQUEST value and clean it up for fdf creation
		foreach( $_REQUEST as $key => $value ) {
		   // Translate tildes back to periods
		   $fdf_data_strings[strtr($key, '~', '.')]= $value;
		}
		
		// Name of file to be downloaded
		$pdf_filename = "$page1_field1_$page1_field2_$page1_field3.pdf";
		
		// Name/location of original, empty PDF form
		$pdf_original = "example.pdf";
		
		// Finally make the actual PDF file!
		$pdfmaker->make_pdf($fdf_data_strings, $fdf_data_names, $fields_hidden, $fields_readonly, $pdf_original, $pdf_filename);
		// The end!
	}
?> 