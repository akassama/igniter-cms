<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * ThemesModel class
 *
 * Represents the model for the themes table in the database.
 */
class ThemesModel extends Model
{
    protected $table            = 'themes';
    protected $primaryKey       = 'theme_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'theme_id', 
        'name',
        'path', 
        'primary_color',
        'secondary_color',
        'other_color',
        'image',
        'theme_url',
        'theme_bg_image',
        'theme_bg_video',
        'footer_copyright',
        'category',
        'sub_category',
        'selected',
        'deletable',
        'home_page',
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
        'name' => 'required|max_length[100]|is_unique[themes.name]',
        'path' => 'required|max_length[255]|is_unique[themes.path]',
    ];
    protected $validationMessages   = [
        'path' => 'path is required',
        'name' => 'name is required',
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

    public function createTheme($param = array())
    {
        $data = [
            'theme_id' => getGUID(),
            'name' => $param['name'],
            'path' => $param['path'],
            'primary_color' => $param['primary_color'],
            'secondary_color' => $param['secondary_color'],
            'other_color' => $param['other_color'],
            'image' => $param['image'],
            'theme_url' => $param['theme_url'],
            'theme_bg_image' => $param['theme_bg_image'],
            'theme_bg_video' => $param['theme_bg_video'],
            'footer_copyright' => $param['footer_copyright'],
            'category' => $param['category'],
            'sub_category' => $param['sub_category'],
            'selected' => $param['selected'],
            'deletable' => $param['deletable'],
            'home_page' => $param['home_page'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }

    public function updateTheme($themeId, $param = [])
    {
        // Check if record exists
        $existingTheme = $this->find($themeId);
        if (!$existingTheme) {
            return false; // not found
        }

        // Update the fields
        $existingTheme['name'] = $param['name'];
        $existingTheme['path'] = $param['path'];
        $existingTheme['primary_color'] = $param['primary_color'];
        $existingTheme['secondary_color'] = $param['secondary_color'];
        $existingTheme['other_color'] = $param['other_color'];
        $existingTheme['image'] = $param['image'];
        $existingTheme['theme_url'] = $param['theme_url'];
        $existingTheme['theme_bg_image'] = $param['theme_bg_image'];
        $existingTheme['theme_bg_video'] = $param['theme_bg_video'];
        $existingTheme['footer_copyright'] = $param['footer_copyright'];
        $existingTheme['category'] = $param['category'];
        $existingTheme['sub_category'] = $param['sub_category'];
        $existingTheme['selected'] = $param['selected'];
        $existingTheme['deletable'] = $param['deletable'];
        $existingTheme['home_page'] = $param['home_page'];
        $existingTheme['created_by'] = $param['created_by'];
        $existingTheme['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingTheme);

        return true;
    }
}
