<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function register()
    {
        
        helper(['form']);
        $userModel = new \App\Models\UserModel();


        if ($this->request->getMethod() == 'post') {
            // Validate input
            $rules = [
                'uname' => 'required|min_length[3]|max_length[20]',
                'pwd' => 'required|min_length[8]',
                'pwd_confirm' => 'matches[pwd]',
                'fname' => 'required|alpha_space|max_length[15]',
                'lname' => 'required|alpha_space|max_length[15]',
                'email'    => 'required|valid_email',
                'gender' => 'required|in_list[male,female]',
                'dob' => 'required|valid_date',
                'weight' => 'required|decimal|greater_than[0]'
                
            ];

            if (!$this->validate($rules)) {
                // Send back to the form with errors
                return view('register', [
                    'validation' => $this->validator,
                ]);
            } else {
                // Store user in the database
                $userModel = new UserModel();

                // Generate a unique token
                $token = bin2hex(random_bytes(32));

                $data = [
                    'user_username' => $this->request->getVar('uname'),
                    'user_password' => password_hash($this->request->getVar('pwd'), PASSWORD_DEFAULT),
                    // 'user_password' => $this->request->getVar('pwd'),
                    'user_fname' => $this->request->getVar('fname'),
                    'user_lname' => $this->request->getVar('lname'),
                    'user_email'    => $this->request->getVar('email'),
                    'user_sex' => $this->request->getVar('gender'),
                    'user_dob' => $this->request->getVar('dob'),
                    'user_weight' => $this->request->getVar('weight'),
                    'user_joindate' => date('Y-m-d H:i:s'),
                    'user_token' => $token,
                    'user_active' => '0' // Account is inactive until email is verified. 0 = inactive 1 = active
                ];

                log_message('info', 'Form data: ' . print_r($this->request->getPost(), true));

                if ($this->request->getMethod() === 'post') {
                    // $this->sendEmail();
                    log_message('info', 'Form data: ' . print_r($this->request->getPost(), true));
                
                    if ($userModel->save($data)) {

                        log_message('info', 'User registered successfully. Please activate your account');
                        
                    } else {
                        log_message('error', 'User registration failed.');
                    }
                }

                // Sends email
                $email = \Config\Services::email();
                $email->setFrom('unifitinf1005@gmail.com', 'UniFit');
                $email->setTo($data['user_email']);
                $email->setSubject('Account Activation');
                $activationLink = base_url("activate/{$token}"); // Adjust the URL based on your routing
                $email->setMessage("Please click this link to activate your account: " . $activationLink);
                $email->send();
                if (!$email->send()) {
                    // Email sending failed, dump the error
                    echo $email->printDebugger(['headers', 'subject', 'body']);
                }

                // Redirect to a specific page after registering
                echo ("<script>alert('nice!')</script>");
                return redirect()->to('/login');
            }
        }

        // Show registration form
        return view('register');
    }

    public function activate($token)
    {
        $model = new UserModel();

        // Find the user by token
        $user = $model->where('user_token', $token)->first();

        if ($user) {
            // Activate the account
            $model->update($user['user_id'], ['user_active' => 1, 'user_token' => null]);

            // Show a success message or redirect
            return redirect()->to('/login')->with('message', 'Account activated successfully.');

            echo "Account activated successfully.";
        }
    }
    
    public function login()
    {
            helper(['form', 'url']);
            
            if ($this->request->getMethod() == 'post') {
                $session = session();
                $userModel = new UserModel();
                
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('pwd');
                
                $user = $userModel->where('user_email', $email)->first();
                
                if ($user) {
                    if (password_verify($password, $user['user_password'])) {
                        if ($user['user_active'] != 1) {
                            $session->setFlashdata('error', 'Account is not activated.');
                            return redirect()->back();
                        }
                        
                        $ses_data = [
                            'user_id' => $user['user_id'],
                            'user_email' => $user['user_email'],
                            'logged_in' => TRUE
                        ];
                        $session->set($ses_data);

                        // Set a custom cookie if needed
                        $this->response->setCookie('custom_cookie_name', 'cookie_value', 86400); // 86400 seconds = 1 day
                        return redirect()->to('/myWorkout');
                    } else {
                        $session->setFlashdata('error', 'Password is incorrect.');
                        return redirect()->back();
                    }
                } else {
                    $session->setFlashdata('error', 'Email does not exist.');
                    return redirect()->back();
                }
            }
            
            return view('login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    protected function setUserSession($user)
    {
        $data = [
            'user_id' => $user['id'],
            'user_email' => $user['user_email'],
            'logged_in' => true,
        ];

        session()->set($data);
        return true;
    }

    public function forgotPassword()
    {
        helper(['form', 'url']);

        if ($this->request->getMethod() == 'post') {
            $email = $this->request->getPost('email');
            $userModel = new UserModel();
            
            $user = $userModel->where('user_email', $email)->first();
            
            if ($user) {
                $token = bin2hex(random_bytes(32));
                $userModel->update($user['user_id'], [
                    'user_token' => $token,
                ]);
    
                // Prepare the email with the token link
                $resetLink = base_url('reset/resetPassword/' . $token);

                // Send the Email
                if ($this->sendEmail($user['user_email'], 'Password Reset', 'Please click this link to reset your password: ' . $resetLink)) {
                    return redirect()->to('/login')->with('message', 'Check your email for reset instructions.');
                } else {
                    return redirect()->back()->with('error', 'Failed to send reset instructions email.');
                }
    
                return redirect()->to('/login')->with('message', 'Check your email for reset instructions.');
            } else {
                return redirect()->back()->with('error', 'Email not found.');
            }
        }
    
        // Show the forgot password form
        return view('forgotPassword');
    }

    public function resetPassword($token)
    {
        // Display the reset password form view with the token
        return view('resetPassword', ['token' => $token]);
    }

    public function resetPasswordProcess($token)
    {
        helper(['form', 'url']);

        $password = $this->request->getPost('pwd');
        $confirmPassword = $this->request->getPost('pwd_confirm');

        // Check if password is at least 8 characters long
        if (strlen($password) < 8) {
            return redirect()->back()->with('error', 'Password must be at least 8 characters long.');
        }

        // Passwords do not match
        if ($password !== $confirmPassword) {
            
            return redirect()->back()->with('error', 'Passwords do not match.');
        }

        $userModel = new UserModel();
        $user = $userModel->where('user_token', $token)->first();

        if ($user) {
            // Update the user's password and clear the token
            $userModel->update($user['user_id'], [
                'user_password' => password_hash($password, PASSWORD_DEFAULT),
                'user_token' => null
            ]);

            // Redirect with a success message
            return redirect()->to('/login')->with('message', 'Password updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Invalid token.');
        }
    }

    protected function sendEmail($to, $subject, $message)
    {
        $email = \Config\Services::email();
        $email->setFrom('unifitinf1005@gmail.com', 'UniFit');
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);

        // You can add more configuration settings as needed for email, like From Name, From Email, etc.

        if ($email->send()) {
            log_message('info', 'Email sent to: ' . $to);
            return true;
        } else {
            log_message('error', 'Email failed to send to ' . $to . ' Error: ' . $email->printDebugger(['headers']));
            return false;
        }     
    }

}