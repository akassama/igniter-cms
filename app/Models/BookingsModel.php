<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingsModel extends Model
{
    protected $table            = 'bookings';
    protected $primaryKey       = 'booking_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'booking_id',
        'name',
        'email',
        'phone',
        'booking_date',
        'booking_time',
        'no_of_people',
        'message', 
        'other',
        'ip_address',
        'country',
        'device',
        'created_by',
        'updated_by'
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
        'name' => 'required|max_length[255]|min_length[2]',
        'booking_date' => 'required',
    ];
    protected $validationMessages   = [
        'name' => 'Name is required',
        'booking_date' => 'Date is required',
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

    public function createBooking($param = array())
    {
        $bookingId = getGUID();
        $data = [
            'booking_id' => $bookingId,
            'name' => $param['name'],
            'email' => $param['email'],
            'phone' => $param['phone'],
            'booking_date' => $param['booking_date'],
            'booking_time' => $param['booking_time'],
            'no_of_people' => $param['no_of_people'],
            'message' => $param['message'],
            'other' => $param['other'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }
    
    public function updateBooking($bookingId, $param = [])
    {
        // Check if record exists
        $existingBooking = $this->find($bookingId);
        if (!$existingBooking) {
            return false; // not found
        }

        // Update the fields
        $existingBooking['name'] = $param['name'];
        $existingBooking['email'] = $param['email'];
        $existingBooking['phone'] = $param['phone'];
        $existingBooking['booking_date'] = $param['booking_date'];
        $existingBooking['booking_time'] = $param['booking_time'];
        $existingBooking['no_of_people'] = $param['no_of_people'];
        $existingBooking['message'] = $param['message'];
        $existingBooking['other'] = $param['other'];
        $existingBooking['created_by'] = $param['created_by'];
        $existingBooking['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingBooking);

        return true;
    }
}
