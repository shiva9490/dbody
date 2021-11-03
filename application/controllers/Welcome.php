<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function mailtest(){
	    $toemail = 'sivaappalabattula92@gmail.com';
	    $subject= "Sample Testing mail";
	    $messge= "Sample Testing Message";
	   echo $this->common_config->configemail($toemail,$subject,$messge);
	}
	public function smstest(){
	    $phone_number= "6302838564";
	    $message_string= "Sample Testing Message";
	   echo $this->common_config->sendmobilemessage($phone_number,$message_string);
	}
	
}
