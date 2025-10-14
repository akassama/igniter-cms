<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class FormsController extends BaseController
{
    protected $session;
    public function __construct()
    {
        // Initialize session once in the constructor
        $this->session = session();
    }

    public function index()
    {
        return view('back-end/forms/index');
    }

    //############################//
    //          Contact           //
    //############################//
    public function contactForms()
    {
        return view('back-end/forms/contact-forms/index');
    }

    public function saveContactForm()
    {
        // Access session data in this method
        $userId = $this->session->get('user_id');
    }


    //############################//
    //         Bookings           //
    //############################//
    public function bookingForms()
    {
        return view('back-end/forms/booking-forms/index');
    }

    public function saveBookingForm()
    {
        // Access session data in this method
        $userId = $this->session->get('user_id');
    }


    //############################//
    //       Subscription         //
    //############################//
    public function subscriptionForms()
    {
        return view('back-end/forms/subscription-forms/index');
    }

    public function saveSubscriptionForm()
    {
        // Access session data in this method
        $userId = $this->session->get('user_id');
    }


    //############################//
    //         Form Fields        //
    //############################//
    public function formFields()
    {
        return view('back-end/forms/form-fields/index');
    }

    public function saveFormField()
    {
        // Access session data in this method
        $userId = $this->session->get('user_id');
    }


    //############################//
    //       Form Settings        //
    //############################//
    public function formSettings()
    {
        return view('back-end/forms/form-settings/index');
    }

    public function saveFormSettings()
    {
        // Access session data in this method
        $userId = $this->session->get('user_id');
    }
}
