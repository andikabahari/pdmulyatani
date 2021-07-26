<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_lib {

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();

        $this->CI->load->library('session');
        $this->CI->load->model('pengguna_model');
    }

    public function id()
    {
        return ! empty($this->CI->session->userdata('id_pengguna'))
                ? $this->CI->session->userdata('id_pengguna')
                : NULL;
    }

    public function pengguna()
    {
        $id = $this->id();
        $pengguna = $this->CI->pengguna_model->find($id);

        return ! empty($pengguna) ? $pengguna : NULL;
    }

    public function is_logged_in()
    {
        return ! empty($this->pengguna());
    }

    public function redirect_if_authenticated($to_url = '')
    {
        if ($this->is_logged_in())
        {
            redirect($to_url);
        }
    }

    public function redirect_if_not_authenticated($to_url = '')
    {
        if ( ! $this->is_logged_in())
        {
            redirect($to_url);
        }
    }

    public function login($username, $password)
    {
        $pengguna = $this->CI->pengguna_model->where(array('username' => $username), 1);

        if ( ! isset($pengguna[0]))
        {
            return FALSE;
        }

        if (empty($pengguna[0]))
        {
            return FALSE;
        }

        if ( ! $this->verify($password, $pengguna[0]->password))
        {
            return FALSE;
        }

        $this->CI->session->set_userdata('id_pengguna', $pengguna[0]->id_pengguna);
        
        return TRUE;
    }

    public function logout()
    {
        $this->CI->session->unset_userdata('id_pengguna');
    }

    public function hash($password)
    {
        $option = array(
            'cost' => 10
        );

        return password_hash($password, PASSWORD_DEFAULT, $option);
    }

    public function verify($password, $hashed_password)
    {
        return password_verify($password, $hashed_password);
    }
}
