<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingFormsModel extends Model
{
    protected $table            = 'booking_form_submissions';
    protected $primaryKey       = 'booking_form_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'booking_form_id',
        'site_id',
        'form_name',
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'service_id',
        'service_name',
        'appointment_date',
        'appointment_time',
        'duration',
        'number_of_attendees',
        'message',
        'status',
        'confirmation_code',
        'notes',
        'resource_id',
        'resource_name',
        'payment_status',
        'payment_amount',
        'ip_address',
        'country',
        'last_updated_by',
        'created_at',
        'updated_at'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'appointment_date' => 'required|valid_date',
        'email'            => 'required|valid_email',
    ];

    protected $validationMessages = [
        'appointment_date' => [
            'required'   => 'Appointment date is required',
            'valid_date' => 'Please provide a valid date',
        ],
        'email' => [
            'required'    => 'Email is required',
            'valid_email' => 'Please enter a valid email address',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function createBookingSubmission($param = [])
    {
        // Generate a unique booking ID
        $bookingId = getGUID();

        // Prepare data safely using allowed fields
        $data = [
            'booking_form_id'      => $bookingId,
            'site_id'              => $param['site_id']              ?? null,
            'form_name'            => $param['form_name']            ?? 'booking_form',
            'name'                 => $param['name']                 ?? null,
            'first_name'           => $param['first_name']           ?? null,
            'last_name'            => $param['last_name']            ?? null,
            'email'                => $param['email']                ?? null,
            'phone'                => $param['phone']                ?? null,
            'service_id'           => $param['service_id']           ?? null,
            'service_name'         => $param['service_name']         ?? null,
            'appointment_date'     => $param['appointment_date']     ?? null,
            'appointment_time'     => $param['appointment_time']     ?? null,
            'duration'             => $param['duration']             ?? null,
            'number_of_attendees'  => $param['number_of_attendees']  ?? null,
            'message'              => $param['message']              ?? null,
            'status'               => $param['status']               ?? 'pending',
            'confirmation_code'    => $param['confirmation_code']    ?? null,
            'notes'                => $param['notes']                ?? null,
            'resource_id'          => $param['resource_id']          ?? null,
            'resource_name'        => $param['resource_name']        ?? null,
            'payment_status'       => $param['payment_status']       ?? 'unpaid',
            'payment_amount'       => $param['payment_amount']       ?? 0,
            'ip_address'           => $_SERVER['REMOTE_ADDR']        ?? null,
            'country'              => $param['country']              ?? null,
            'last_updated_by'      => $param['last_updated_by']      ?? null,
            'created_at'           => date('Y-m-d H:i:s'),
            'updated_at'           => date('Y-m-d H:i:s')
        ];

        return $this->save($data);
    }


    public function updateBookingSubmission($contactId, $param = [])
    {
        // Check if record exists
        $existingBooking = $this->find($contactId);
        if (!$existingBooking) {
            return false; // not found
        }

        // Update
        $existingBooking['site_id']             = $param['site_id']             ?? $existingBooking['site_id'];
        $existingBooking['form_name']           = $param['form_name']           ?? $existingBooking['form_name'];
        $existingBooking['name']                = $param['name']                ?? $existingBooking['name'];
        $existingBooking['first_name']          = $param['first_name']          ?? $existingBooking['first_name'];
        $existingBooking['last_name']           = $param['last_name']           ?? $existingBooking['last_name'];
        $existingBooking['email']               = $param['email']               ?? $existingBooking['email'];
        $existingBooking['phone']               = $param['phone']               ?? $existingBooking['phone'];
        $existingBooking['service_id']          = $param['service_id']          ?? $existingBooking['service_id'];
        $existingBooking['service_name']        = $param['service_name']        ?? $existingBooking['service_name'];
        $existingBooking['appointment_date']    = $param['appointment_date']    ?? $existingBooking['appointment_date'];
        $existingBooking['appointment_time']    = $param['appointment_time']    ?? $existingBooking['appointment_time'];
        $existingBooking['duration']            = $param['duration']            ?? $existingBooking['duration'];
        $existingBooking['number_of_attendees'] = $param['number_of_attendees'] ?? $existingBooking['number_of_attendees'];
        $existingBooking['message']             = $param['message']             ?? $existingBooking['message'];
        $existingBooking['status']              = $param['status']              ?? $existingBooking['status'];
        $existingBooking['confirmation_code']   = $param['confirmation_code']   ?? $existingBooking['confirmation_code'];
        $existingBooking['notes']               = $param['notes']               ?? $existingBooking['notes'];
        $existingBooking['resource_id']         = $param['resource_id']         ?? $existingBooking['resource_id'];
        $existingBooking['resource_name']       = $param['resource_name']       ?? $existingBooking['resource_name'];
        $existingBooking['payment_status']      = $param['payment_status']      ?? $existingBooking['payment_status'];
        $existingBooking['payment_amount']      = $param['payment_amount']      ?? $existingBooking['payment_amount'];
        $existingBooking['ip_address']          = $_SERVER['REMOTE_ADDR']       ?? $existingBooking['ip_address'];
        $existingBooking['country']             = $param['country']             ?? $existingBooking['country'];
        $existingBooking['last_updated_by']     = $param['last_updated_by']     ?? $existingBooking['last_updated_by'];

        // Save the updated record
        $this->save($existingBooking);

        return true;
    }
}
