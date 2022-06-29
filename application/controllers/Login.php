<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Login extends CI_Controller {  

    public $email = "";
    public $name = "";
    public $errors = array();

    public function __construct()
    {   
        parent::__construct();
        $this->load->helper('url');
    }

    // --------------------------------------------
    // View Controllers
    // --------------------------------------------

    public function index()
    {
        $data = $this->get_data();
        $data['body'] = 'login_view';
        $data['view_type'] = 'no_footer';

        $this->load->view('template', $data);
        $this->session->info = null;
    }
    public function login_admin_view()
    {
        $data = $this->get_data_admin();
        $data['body'] = 'login_admin';
        $data['view_type'] = 'no_footer';
        $data['set_static'] = true;

        $this->load->view('template', $data); 
    }
    public function forgot_password_view()
    {
        $data = $this->get_data();
        $data['body'] = 'forgot_password';
        $data['header_2'] = true;
        $data['title'] = 'Forgot Password';
        $data['view_type'] = 'no_footer';

        $this->load->view('template', $data);
    }
    public function verify_otp_view()
    {
        $data = $this->get_data();

        $data['header_2'] = true;
        $data['body'] = 'verify_otp';
        $data['title'] = 'Code Verification';
        $data['view_type'] = 'no_footer';

        $this->load->view('template', $data);
    }
    public function new_passsword_view()
    {
        $data = $this->get_data();

        $data['header_2'] = true;
        $data['body'] = 'new_password';
        $data['title'] = 'Create a New Password';
        $data['view_type'] = 'no_footer';

        $this->load->view('template', $data);
    }
    public function signup_user_view()
    {
        $data = $this->get_data();
        $data['body'] = 'signup_user';
        $data['view_type'] = 'no_footer';
        $data['set_static'] = true;

        $this->load->view('template', $data);
    }


    // --------------------------------------------
    // Core Controllers
    // --------------------------------------------

    public function login()
    {
        $_errors = array();

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $query = $this->db->get_where('usertable', array('email' => $email));

        if ($query->num_rows() > 0)
        {
            $row = $query->row();
            $fetch_pass = $row->password;

            if (password_verify($password, $fetch_pass))
            {
                $status = $row->status;

                if($status == 'verified')
                {
                    $this->session->email = $email;
                    $this->session->unique_id = $row->unique_id;
                    $this->session->fname = $row->fname;

                    redirect('User');
                }
                else
                {
                    $info = "It's look like you haven't still verify your email - $email";
                    $this->session->info = $info;

                    redirect('Login/verify_otp_view');
                }
            }
            else
            {
                $_errors['email'] = "Incorrect email or password!";
            }
        }
        else
        {
            $_errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
        }
        
      
        $this->errors = array_merge($this->errors, $_errors);
        $this->index();

        // if ($user=='juhi' && $pass=='123')
        // {  
        //     //Declaring session  
        //     // $this->session->set_userdata(array('user'=>$user));  
        //     $this->load->view('_welcome_view');  
        // }
        // else
        // {
        //     $errors = array();
        //     $errors['error'] = 'Your Account is Invalid';  
        //     $this->load->view('login_view', $errors);  
        // }
    }
    public function logout()  
    {  
        // Removing session  
        $this->session->unset_userdata('user');  
        redirect("Login");  
    }
    public function forgot_password()
    {
        $email = $this->input->post('email');
        $_errors = array();

        $query = $this->db->get_where('usertable', array('email' => $email));

        if ($query->num_rows() > 0)
        {
            $code = rand(999999, 111111);
            
            $data = array('code' => $code);
            $status = $this->db->update('usertable', $data, array('email' => $email));

            if (!empty($status) && $status > 0)
            {
                // TODO: Consideration for CodeIgniter Mail Class
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: shahiprem7890@gmail.com";

                if(mail($email, $subject, $message, $sender))
                {
                    $info = "We've sent a password reset OTP to your email - $email";
                    $this->session->info = $info;
                    $this->session->email = $email;

                    redirect('Login/verify_otp_view');
                }
                else
                {
                    $_errors['otp-error'] = "Failed while sending code!";
                }
            }
            else
            {
                $_errors['db-error'] = "Something went wrong!";
            }
        }
        else
        {
            $_errors['email'] = "This email address does not exist!";
        }
        
        $this->errors = array_merge($this->errors, $_errors);
        $this->forgot_password_view();
    }
    public function verify_otp()
    {
        $this->session->info = null;

        $otp = $this->input->post('otp');
        $email = $this->session->email;
        
        $query = $this->db->get_where('usertable', array('code' => $otp, 'email' => $email));

        if($query->num_rows() > 0)
        {

            $row = $query->row();
            if ($row->status != 'verified')
            {
                $this->db->update('usertable', ['status' => 'verified'], array('email' => $email));
            }

            $info = "Please create a new password that you don't use on any other site.";
            $this->session->info = $info;

            redirect('Login/new_passsword_view');
        }
        else
        {
            $_errors['otp-error'] = "You've entered incorrect code!";
        }

        $this->errors = array_merge($this->errors, $_errors);
        $this->verify_otp_view();
    }
    public function change_password()
    {   
        $this->session->info = null;
        $password = $this->input->post('password');
        $cpassword = $this->input->post('cpassword');

        if($password !== $cpassword)
        {
            $_errors['password'] = "Passwords do not matched!";
        }
        else
        {
            $code = 0;
            $email = $this->session->email;
            $encrypt_pass = password_hash($password, PASSWORD_BCRYPT);
            // "UPDATE usertable SET code = $code, password = '$encrypt_pass' WHERE email = '$email'";
            $data = array('code' => $code, 'password' => $encrypt_pass);
            $status = $this->db->update('usertable', $data, array('email' => $email));

            if (!empty($status) && $status > 0)
            {
                $info = "Your password changed. Now you can login with your new password.";
                $this->session->info = $info;
                
                $this->redirect_to_base();
            }
            else
            {
                $errors['db-error'] = "Failed to change your password!";
            }
        }
        $this->errors = array_merge($this->errors, $_errors);
        $this->new_passsword_view();
    }
    public function signup_user()   
    {
        $_errors = array();

        $first = $this->input->post('first');
        $last = $this->input->post('last');
        $address = $this->input->post('address');
        $years = $this->input->post('years');
        $crops = $this->input->post('crops');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $cpassword = $this->input->post('cpassword');
    
        if($password !== $cpassword)
        {
            $_errors['password'] = "Passwords do not matched!";
        }

        // "SELECT * FROM usertable WHERE email = '$email'";
        $query = $this->db->get_where('usertable', array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $_errors['email'] = "Email that you have entered is already exist!";
        }

        if(count($_errors) === 0)
        {
            $encypt_pass = password_hash($password, PASSWORD_BCRYPT);

            $code = rand(999999, 111111);
            $ran_id = rand(time(), 100000000);
            $status = "not_verified";
    
            $data = [
                'unique_id' => $ran_id,
                'fname'  => $first,
                'lname'  => $last,
                'address'  => $address,
                'years'  => $years,
                'kindofCrops'  => $crops,
                'email'  => $email,
                'password'  => $encypt_pass,
                'code'  => $code,
                'status'  => $status
            ];
            $this->db->insert('usertable', $data);

            if ($this->db->affected_rows() > 0)
            {
                $subject = "Email Verification Code";
                $message = "Your verification code is $code";
                $sender = "From: shahiprem7890@gmail.com";

                if(mail($email, $subject, $message, $sender))
                {
                    $info = "We've sent a verification code to your email - $email";

                    $this->session->info = $info;
                    $this->session->email = $email;
                    $this->session->password = $password;
                    $this->session->unique_id = $ran_id;

                    redirect('Login/verify_otp_view');
                }
                else
                {
                    $_errors['otp-error'] = "Failed while sending code!";
                }
            }
            else
            {
                $_errors['db-error'] = "Failed while inserting data into database!";
            }
        }

        $this->errors = array_merge($this->errors, $_errors);
        $this->signup_user_view();
    }

    
    // --------------------------------------------
    // Other Controllers (Utilities)
    // --------------------------------------------

    private function get_data()
    {
        $data['name'] = $this->name;
        $data['email'] = $this->email;
        $data['errors'] = $this->errors;
     
        return $data;
    }
    private function get_data_admin()
    {
        $data['username'] = '';
        $data['password'] = '';
        $data['username_err'] = '';
        $data['password_err'] = '';
        $data['login_err'] = '';

        return $data;
    }
    public function redirect_to_base()
    {
        redirect(base_url(), 'location');
    }
}
