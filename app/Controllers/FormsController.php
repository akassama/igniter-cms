<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DataGroupsModel;
use App\Models\BookingFormsModel;
use App\Models\ContactFormsModel;
use App\Models\SubscriptionFormsModel;

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
        $tableName = 'contact_form_submissions';
        $contactFormsModel = new ContactFormsModel();

        // Set data to pass in view
        $data = [
            'contact_form_submissions' => $contactFormsModel->where('is_archived', 0)->orderBy('created_at', 'DESC')->paginate(intval(env('QUERY_LIMIT_ULTRA_MAX', 10000))),
            'pager' => $contactFormsModel->pager,
            'total_contact_form_submissions' => $contactFormsModel->pager->getTotal()
        ];

        return view('back-end/forms/contact-forms/index', $data);
    }

    public function viewContactMessage($contactMessageId)
    {
        //mark as read
        $updateColumn =  "'is_read' = '1'";
        $updateWhereClause = "contact_form_id = '$contactMessageId'";
        $result = updateRecordColumn("contact_form_submissions", $updateColumn, $updateWhereClause);

        $contactMessagesModel = new ContactFormsModel();

        // Fetch the data based on the id
        $contactMessage = $contactMessagesModel->where('contact_form_id', $contactMessageId)->first();

        if (!$contactMessage) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/forms/contact-forms');
        }

        // Set data to pass in view
        $data = [
            'contact_message_data' => $contactMessage
        ];

        return view('back-end/forms/contact-forms/view-contact', $data);
    }

    public function archiveContactMessage($contactMessageId)
    {
        //mark as archived
        $updateColumn =  "'is_archived' = '1'";
        $updateWhereClause = "contact_form_id = '$contactMessageId'";
        $result = updateRecordColumn("contact_form_submissions", $updateColumn, $updateWhereClause);

        session()->setFlashdata('toastrSuccessAlert', "Contact message archived.");

        return redirect()->to('/account/forms/contact-forms');
    }

    public function archivedMessages()
    {
        $tableName = 'contact_form_submissions';
        $contactFormsModel = new ContactFormsModel();

        // Set data to pass in view
        $data = [
            'contact_form_submissions' => $contactFormsModel->where('is_archived', 1)->orderBy('created_at', 'DESC')->paginate(intval(env('QUERY_LIMIT_ULTRA_MAX', 10000))),
            'pager' => $contactFormsModel->pager,
            'total_contact_form_submissions' => $contactFormsModel->pager->getTotal()
        ];

        return view('back-end/forms/contact-forms/archived-messages', $data);
    }

    public function unArchiveContactMessage($contactMessageId)
    {
        //mark as un-archived
        $updateColumn =  "'is_archived' = '0'";
        $updateWhereClause = "contact_form_id = '$contactMessageId'";
        $result = updateRecordColumn("contact_form_submissions", $updateColumn, $updateWhereClause);

        session()->setFlashdata('toastrSuccessAlert', "Contact message removed from archived.");

        return redirect()->to('/account/forms/contact-forms');
    }

    public function updateContactNotes()
    {
        $contactFormsModel = new ContactFormsModel();

        // Basic validation
        $rules = [
            'contact_form_id' => 'required',
            'notes'           => 'permit_empty|max_length[5000]',
        ];

        if (! $this->validate($rules)) {
            session()->setFlashdata('toastrErrorAlert', 'Invalid input. Please check and try again.');
            return redirect()->back()->withInput();
        }

        $contactFormId    = $this->request->getPost('contact_form_id'); // UUID as string
        $notes = $this->request->getPost('notes');

        // Try to update notes
        try {
            $contactFormsModel->update($contactFormId, ['notes' => $notes]);
            session()->setFlashdata('toastrSuccessAlert', 'Notes updated successfully.');
            return redirect()->to(base_url('account/forms/contact-forms/view-contact/' . $contactFormId));
        } catch (\Throwable $e) {
            log_message('error', 'Error updating contact notes: ' . $e->getMessage());
            session()->setFlashdata('toastrErrorAlert', 'Failed to update notes. Please try again.');
            return redirect()->back()->withInput();
        }
    }

    public function updateContactStatus()
    {
        $contactFormsModel = new ContactFormsModel();

        // Basic validation
        $rules = [
            'contact_form_id' => 'required',
            'status'           => 'permit_empty|in_list['.getDataGroupList("ContactFomrStatus").']',
        ];

        if (! $this->validate($rules)) {
            session()->setFlashdata('toastrErrorAlert', 'Invalid input. Please check and try again.');
            return redirect()->back()->withInput();
        }

        $contactFormId    = $this->request->getPost('contact_form_id');
        $status = $this->request->getPost('status');

        // Try to update status
        try {
            $contactFormsModel->update($contactFormId, ['status' => $status]);
            session()->setFlashdata('toastrSuccessAlert', 'Status updated successfully.');
            return redirect()->to(base_url('account/forms/contact-forms/view-contact/' . $contactFormId));
        } catch (\Throwable $e) {
            log_message('error', 'Error updating contact status: ' . $e->getMessage());
            session()->setFlashdata('toastrErrorAlert', 'Failed to update status. Please try again.');
            return redirect()->back()->withInput();
        }
    }

    //############################//
    //         Bookings           //
    //############################//
    public function bookingForms()
    {
        $bookingFormsModel = new BookingFormsModel();

        $today = date('Y-m-d');

        $data = [
            'booking_form_submissions' => $bookingFormsModel
                ->where('appointment_date >=', $today)
                ->orderBy('appointment_date', 'ASC')
                ->paginate((int) env('QUERY_LIMIT_MAX', 1000)),
            'pager' => $bookingFormsModel->pager,
            'total_booking_form_submissions' => $bookingFormsModel->pager->getTotal(),
        ];

        return view('back-end/forms/booking-forms/index', $data);
    }

    public function expiredBookingForms()
    {
        $bookingFormsModel = new BookingFormsModel();

        $today = date('Y-m-d');

        $data = [
            'booking_form_submissions' => $bookingFormsModel
                ->where('appointment_date <', $today)
                ->orderBy('appointment_date', 'DESC')
                ->paginate((int) env('QUERY_LIMIT_MAX', 1000)),
            'pager' => $bookingFormsModel->pager,
            'total_booking_form_submissions' => $bookingFormsModel->pager->getTotal(),
        ];

        return view('back-end/forms/booking-forms/expired-bookings', $data);
    }

    public function viewBooking($booking_form_id = null)
    {
        $bookingFormsModel = new BookingFormsModel();

        // Ensure ID provided
        if (empty($booking_form_id)) {
            return redirect()->to('/account/forms/booking-forms');
        }

        // Fetch the booking
        $booking = $bookingFormsModel->where('booking_form_id', $booking_form_id)->first();

        // If not found, show 404
        if (!$booking) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/forms/booking-forms');
        }

        // Pass booking data to the view
        $data = [
            'title' => 'View Booking Details',
            'booking' => $booking,
        ];

        return view('back-end/forms/booking-forms/view-booking', $data);
    }

    public function updateBookingNotes()
    {
        $bookingFormsModel = new BookingFormsModel();

        // Basic validation
        $rules = [
            'booking_form_id' => 'required',
            'notes'           => 'permit_empty|max_length[5000]',
        ];

        if (! $this->validate($rules)) {
            session()->setFlashdata('toastrErrorAlert', 'Invalid input. Please check and try again.');
            return redirect()->back()->withInput();
        }

        $bookingFormId    = $this->request->getPost('booking_form_id'); // UUID as string
        $notes = $this->request->getPost('notes');

        // Try to update notes
        try {
            $bookingFormsModel->update($bookingFormId, ['notes' => $notes]);
            session()->setFlashdata('toastrSuccessAlert', 'Notes updated successfully.');
            return redirect()->to(base_url('account/forms/booking-forms/view-booking/' . $bookingFormId));
        } catch (\Throwable $e) {
            log_message('error', 'Error updating booking notes: ' . $e->getMessage());
            session()->setFlashdata('toastrErrorAlert', 'Failed to update notes. Please try again.');
            return redirect()->back()->withInput();
        }
    }

        public function updateBooking()
    {
        $bookingFormsModel = new BookingFormsModel();

        // Validation rules (adjust if you allow more statuses)
        $rules = [
            'booking_form_id'     => 'required',
            'name'                => 'permit_empty|max_length[255]',
            'email'               => 'permit_empty|valid_email|max_length[255]',
            'phone'               => 'permit_empty|max_length[50]',
            'appointment_date'    => 'permit_empty|valid_date[Y-m-d]',
            'appointment_time'    => 'permit_empty|regex_match[/^\d{2}:\d{2}(:\d{2})?$/]',
            'duration'            => 'permit_empty|integer',
            'number_of_attendees' => 'permit_empty|integer',
            'payment_status'      => 'permit_empty|in_list['.getDataGroupList("BookingFomrPaymentStatus").']',
            'payment_amount'      => 'permit_empty|decimal',
            'confirmation_code'   => 'permit_empty|max_length[50]',
            'status'              => 'permit_empty|in_list['.getDataGroupList("BookingFomrStatus").']',
            'notes'               => 'permit_empty|max_length[5000]',
        ];

        if (! $this->validate($rules)) {
            session()->setFlashdata('toastrErrorAlert', 'Invalid input. Please check and try again.');
            return redirect()->back()->withInput();
        }

        $id = $this->request->getPost('booking_form_id');

        // Build update payload (convert empty strings to null to keep DB clean)
        $payload = [
            'name'                 => $this->nullIfEmpty($this->request->getPost('name')),
            'email'                => $this->nullIfEmpty($this->request->getPost('email')),
            'phone'                => $this->nullIfEmpty($this->request->getPost('phone')),
            'appointment_date'     => $this->nullIfEmpty($this->request->getPost('appointment_date')),
            'appointment_time'     => $this->nullIfEmpty($this->request->getPost('appointment_time')),
            'duration'             => $this->nullIfEmpty($this->request->getPost('duration')),
            'number_of_attendees'  => $this->nullIfEmpty($this->request->getPost('number_of_attendees')),
            'payment_status'       => $this->nullIfEmpty($this->request->getPost('payment_status')),
            'payment_amount'       => $this->nullIfEmpty($this->request->getPost('payment_amount')),
            'confirmation_code'    => $this->nullIfEmpty($this->request->getPost('confirmation_code')),
            'status'               => $this->nullIfEmpty($this->request->getPost('status')),
            'notes'                => $this->nullIfEmpty($this->request->getPost('notes')),
        ];

        try {
            // If your model primaryKey is 'booking_form_id', this works:
            $bookingFormsModel->update($id, $payload);

            // If your model uses another PK, uncomment the fallback:
            // $bookingFormsModel->where('booking_form_id', $id)->set($payload)->update();

            session()->setFlashdata('toastrSuccessAlert', 'Booking updated successfully.');
            return redirect()->to(base_url('account/forms/booking-forms/view-booking/' . $id));
        } catch (\Throwable $e) {
            log_message('error', 'Error updating booking: ' . $e->getMessage());
            session()->setFlashdata('toastrErrorAlert', 'Failed to update booking. Please try again.');
            return redirect()->back()->withInput();
        }
    }


    //############################//
    //       Subscription         //
    //############################//
    public function subscriptionForms()
    {
        $tableName = 'subscription_form_submissions';
        $subscriptionFormsModel = new SubscriptionFormsModel();

        // Set data to pass in view
        $data = [
            'subscription_form_submissions' => $subscriptionFormsModel
                ->where('status !=', 'Unsubscribed')
                ->orderBy('created_at', 'DESC')
                ->paginate((int) env('QUERY_LIMIT_ULTRA_MAX', 10000)),

            'pager' => $subscriptionFormsModel->pager,
            'total_subscription_form_submissions' => $subscriptionFormsModel->pager->getTotal(),
        ];

        return view('back-end/forms/subscription-forms/index', $data);
    }

    /**
     * Small helper to normalize empty strings to null.
     */
    private function nullIfEmpty($value)
    {
        return ($value === '' || $value === null) ? null : $value;
    }
}
